@extends('fe.master')
@section('navbar')
    @include('fe.navbar')
@endsection
@section('keranjang')

    <!-- Hero Section Cart -->
    <style>
        .cart-hero {
            background: linear-gradient(90deg, #e0f7fa 60%, #fff 100%);
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(13,202,240,0.08);
            padding: 2.5rem 2rem 2rem 2rem;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
        }
        .cart-hero-img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 2px 12px rgba(13,202,240,0.10);
            margin-right: 1.5rem;
        }
        .cart-hero-content h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #0dcaf0;
            margin-bottom: 0.5rem;
        }
        .cart-hero-content p {
            font-size: 1.1rem;
            color: #444;
            margin-bottom: 0.5rem;
        }
        .cart-hero-content .hero-highlight {
            color: #0dcaf0;
            font-weight: 600;
        }
        @media (max-width: 767px) {
            .cart-hero {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem 1rem;
            }
            .cart-hero-img {
                margin: 0 auto 1rem auto;
            }
        }
    </style>
    <div class="container py-4">
        <div class="cart-hero">
            <img src="{{ asset('fe/img/cart-hero.png') }}" alt="Keranjang Belanja" class="cart-hero-img"
                onerror="this.src='https://img.icons8.com/fluency/96/shopping-cart.png'">
            <div class="cart-hero-content">
                <h1><i class="fa fa-shopping-cart hero-highlight"></i> Keranjang Belanja</h1>
                <p>
                    Cek kembali produk pilihanmu sebelum <span class="hero-highlight">lanjut ke pembayaran</span>.<br>
                    Nikmati <span class="hero-highlight">harga spesial</span> dan <span class="hero-highlight">pengiriman cepat</span> dari Apotek Medicare!
                </p>
                <p>
                    <i class="fa fa-shield-heart text-info"></i> Aman & Terpercaya &nbsp; | &nbsp;
                    <i class="fa fa-truck-fast text-info"></i> Pengiriman Seluruh Indonesia
                </p>
            </div>
        </div>
    </div>
    <!-- End Hero Section Cart -->

    {{-- <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Keranjang</h1>
        </div>
    </div> --}}

    <div class="container py-5">
        <h2 class="mb-4">Keranjang Obat</h2>

        @if (count($cart_items ?? []) > 0)
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($cart_items as $index => $item)
                                <div class="row mb-3 border-bottom pb-3 align-items-center">
                                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" class="cart-checkbox" data-index="{{ $index }}"
                                                data-price="{{ $item['price'] * $item['quantity'] }}" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid rounded"
                                            alt="{{ $item['name'] }}">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $item['name'] }}</h5>
                                        <p class="text-muted mb-1">Harga Satuan: Rp
                                            {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        <div class="d-flex align-items-center mb-2">
                                            <form action="{{ route('cart.updateQuantity', $item['id']) }}" method="POST"
                                                class="d-flex align-items-center me-2 update-qty-form">
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-danger fw-bold">-</button>
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                    class="form-control mx-2 quantity-input text-center" style="width: 60px" min="1" readonly>
                                                <button type="button" class="btn btn-sm btn-success fw-bold">+</button>
                                            </form>
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST"
                                                onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger ms-2">Hapus</button>
                                            </form>
                                        </div>
                                        @if($item['is_keras'] ?? false)
                                            <div class="mt-2">
                                                <span class="badge bg-danger">Obat Keras - Perlu Resep</span>
                                                <div class="input-group mt-1" style="max-width: 300px;">
                                                    <input type="file" 
                                                           class="form-control form-control-sm resep-upload" 
                                                           data-item-id="{{ $item['id'] }}"
                                                           accept="image/*"
                                                           required>
                                                </div>
                                            </div>
                                        @endif
                                        <div>
                                            <span class="fw-bold">Subtotal:</span>
                                            <span class="text-info subtotal-display">
                                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ringkasan Belanja</h5>
                            <div class="d-flex justify-content-between mt-3">
                                <span>Total Harga</span>
                                <strong id="total-harga-display">Rp
                                    {{ number_format($total_price ?? 0, 0, ',', '.') }}</strong>
                            </div>
                            <form id="checkout-form" action="{{ route('checkout.index') }}" method="GET">
                                <input type="hidden" name="selected_products" id="selected-products-input">
                                <button type="submit" class="btn btn-info w-100 mt-3" style="border-radius: 20px">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <h4>Keranjang Belanja Kosong</h4>
                <a href="{{ route('product.index') }}" class="btn btn-success mt-3" style="font-family: 'Poppins', sans-serif; border-radius: 20px; padding: 12px; font-size: 16px; ">Mulai Belanja</a>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Store uploaded resep files
                const resepFiles = {};
                
                document.querySelectorAll('.resep-upload').forEach(input => {
                    input.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        const itemId = this.dataset.itemId;
                        
                        if (file) {
                            const formData = new FormData();
                            formData.append('resep', file);
                            formData.append('_token', '{{ csrf_token() }}');

                            fetch('{{ route("checkout.uploadResep") }}', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    resepFiles[itemId] = data.path;
                                    Swal.fire('Sukses', 'Resep berhasil diupload', 'success');
                                }
                            })
                            .catch(() => {
                                Swal.fire('Error', 'Gagal mengupload resep', 'error');
                            });
                        }
                    });
                });

                // Tombol +
                document.querySelectorAll('.update-qty-form .btn-success').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const form = btn.closest('.update-qty-form');
                        const input = form.querySelector('input[name="quantity"]');
                        input.value = parseInt(input.value) + 1;
                        updateSubtotal(input);
                        submitQtyForm(form);
                    });
                });

                // Tombol -
                document.querySelectorAll('.update-qty-form .btn-danger').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const form = btn.closest('.update-qty-form');
                        const input = form.querySelector('input[name="quantity"]');
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;
                            updateSubtotal(input);
                            submitQtyForm(form);
                        }
                    });
                });

                function submitQtyForm(form) {
                    const url = form.action;
                    const token = form.querySelector('input[name="_token"]').value;
                    const qty = form.querySelector('input[name="quantity"]').value;
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ quantity: qty })
                    }).then(response => {
                        // Optionally handle response
                    });
                }

                function updateSubtotal(input) {
                    const form = input.closest('form');
                    const priceText = form.closest('.col-md-8').querySelector('.text-muted').innerText;
                    const price = parseInt(priceText.replace(/\D/g, ''));
                    const subtotal = price * parseInt(input.value);
                    form.closest('.col-md-8').querySelector('.subtotal-display').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                    const checkbox = form.closest('.row').querySelector('.cart-checkbox');
                    if (checkbox) {
                        checkbox.setAttribute('data-price', subtotal);
                    }
                    updateTotalHarga();
                }

                function updateTotalHarga() {
                    let total = 0;
                    document.querySelectorAll('.cart-checkbox').forEach(function(checkbox) {
                        if (checkbox.checked) {
                            total += parseInt(checkbox.getAttribute('data-price'));
                        }
                    });
                    document.getElementById('total-harga-display').innerText = 'Rp ' + total.toLocaleString('id-ID');
                }

                document.querySelectorAll('.cart-checkbox').forEach(function(checkbox) {
                    checkbox.addEventListener('change', updateTotalHarga);
                });

                // Inisialisasi total harga saat halaman dimuat
                updateTotalHarga();

                // Kirim produk terpilih ke checkout
                document.getElementById('checkout-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    let selected = [];
                    document.querySelectorAll('.cart-checkbox').forEach(function(checkbox) {
                        if (checkbox.checked) {
                            selected.push(checkbox.closest('.row').querySelector('input[name="quantity"]').form.action.split('/').pop());
                        }
                    });
                    document.getElementById('selected-products-input').value = selected.join(',');
                    this.submit();
                });

                // Modify checkout form submit
                document.getElementById('checkout-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Check if all required resep are uploaded
                    const kerasItems = document.querySelectorAll('.resep-upload[required]');
                    let missingResep = false;
                    
                    kerasItems.forEach(input => {
                        const itemId = input.dataset.itemId;
                        if (!resepFiles[itemId]) {
                            missingResep = true;
                        }
                    });

                    if (missingResep) {
                        Swal.fire('Perhatian', 'Harap upload resep untuk obat keras terlebih dahulu', 'warning');
                        return;
                    }

                    this.submit();
                });
            });
        </script>
    @endpush
@endsection
@section('footer')
    @include('fe.footer')
@endsection
