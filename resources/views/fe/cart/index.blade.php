@extends('fe.master')
@section('navbar')
    @include('fe.navbar')
@endsection
@section('keranjang')

{{-- ===== Hero Banner ===== --}}
<div class="cart-hero">
    <div class="cart-hero__bg-orb cart-hero__bg-orb--1"></div>
    <div class="cart-hero__bg-orb cart-hero__bg-orb--2"></div>
    <div class="cart-hero__grid"></div>
    <div class="container position-relative" style="z-index:2;">
        <div class="cart-hero__inner">
            <div class="cart-hero__eyebrow">
                <span class="cart-hero__eyebrow-dot"></span>
                Apotek Medicare
            </div>
            <h1 class="cart-hero__title">
                <i class="fas fa-shopping-bag me-2"></i>
                Keranjang <span class="cart-hero__title-accent">Belanja</span>
            </h1>
            <p class="cart-hero__desc">
                Cek kembali produk pilihanmu sebelum lanjut ke pembayaran. Nikmati harga spesial dan pengiriman cepat!
            </p>
            <div class="cart-hero__badges">
                <span class="cart-hero__badge"><i class="fas fa-shield-alt"></i> Aman & Terpercaya</span>
                <span class="cart-hero__badge"><i class="fas fa-shipping-fast"></i> Pengiriman Seluruh Indonesia</span>
            </div>
        </div>
    </div>
</div>

{{-- ===== Main Cart Area ===== --}}
<div class="cart-main">
    <div class="container">

        @if (count($cart_items ?? []) > 0)
            <div class="cart-layout">

                {{-- ===== Left: Items ===== --}}
                <div class="cart-items-panel">
                    <div class="cart-items-panel__header">
                        <h2 class="cart-items-panel__title">
                            <i class="fas fa-box-open me-2"></i>Produk Dipilih
                        </h2>
                        <span class="cart-items-panel__count">{{ count($cart_items) }} item</span>
                    </div>

                    @foreach ($cart_items as $index => $item)
                        <div class="cart-item">
                            {{-- Checkbox --}}
                            <div class="cart-item__check">
                                <label class="cart-check">
                                    <input type="checkbox"
                                           class="cart-check__input cart-checkbox"
                                           data-index="{{ $index }}"
                                           data-price="{{ $item['price'] * $item['quantity'] }}"
                                           checked>
                                    <span class="cart-check__box"></span>
                                </label>
                            </div>

                            {{-- Image --}}
                            <div class="cart-item__img-wrap">
                                <img src="{{ asset('storage/' . $item['image']) }}"
                                     class="cart-item__img"
                                     alt="{{ $item['name'] }}">
                            </div>

                            {{-- Info --}}
                            <div class="cart-item__info">
                                <h3 class="cart-item__name">{{ $item['name'] }}</h3>
                                <div class="cart-item__unit-price">
                                    Harga satuan: <strong>Rp {{ number_format($item['price'], 0, ',', '.') }}</strong>
                                </div>

                                @if($item['is_keras'] ?? false)
                                    <div class="cart-item__keras">
                                        <span class="cart-item__keras-badge">
                                            <i class="fas fa-exclamation-triangle"></i> Obat Keras — Perlu Resep
                                        </span>
                                        <div class="cart-item__resep-wrap">
                                            <label class="cart-item__resep-label">Upload Resep Dokter</label>
                                            <div class="cart-item__resep-input-wrap">
                                                <i class="fas fa-file-medical cart-item__resep-icon"></i>
                                                <input type="file"
                                                       class="cart-item__resep-input resep-upload"
                                                       data-item-id="{{ $item['id'] }}"
                                                       accept="image/*"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Qty controls --}}
                                <div class="cart-item__bottom">
                                    <div class="cart-qty">
                                        <form action="{{ route('cart.updateQuantity', $item['id']) }}" method="POST"
                                              class="cart-qty__form update-qty-form">
                                            @csrf
                                            <button type="button" class="cart-qty__btn cart-qty__btn--minus">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number"
                                                   name="quantity"
                                                   value="{{ $item['quantity'] }}"
                                                   class="cart-qty__input quantity-input"
                                                   min="1"
                                                   readonly>
                                            <button type="button" class="cart-qty__btn cart-qty__btn--plus">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="cart-item__subtotal">
                                        <span class="cart-item__subtotal-label">Subtotal</span>
                                        <span class="cart-item__subtotal-value subtotal-display">
                                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST"
                                          onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                        @csrf
                                        <button type="submit" class="cart-item__remove-btn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ===== Right: Summary ===== --}}
                <div class="cart-summary">
                    <div class="cart-summary__header">
                        <h3 class="cart-summary__title">Ringkasan Belanja</h3>
                    </div>

                    <div class="cart-summary__body">
                        <div class="cart-summary__row">
                            <span class="cart-summary__row-label">Total Item</span>
                            <span class="cart-summary__row-value">{{ count($cart_items) }} produk</span>
                        </div>
                        <div class="cart-summary__divider"></div>
                        <div class="cart-summary__row cart-summary__row--total">
                            <span class="cart-summary__row-label">Total Harga</span>
                            <strong class="cart-summary__total-value" id="total-harga-display">
                                Rp {{ number_format($total_price ?? 0, 0, ',', '.') }}
                            </strong>
                        </div>

                        <form id="checkout-form" action="{{ route('checkout.index') }}" method="GET">
                            <input type="hidden" name="selected_products" id="selected-products-input">
                            <button type="submit" class="cart-summary__checkout-btn">
                                <i class="fas fa-credit-card me-2"></i>
                                Checkout Sekarang
                                <i class="fas fa-arrow-right cart-summary__checkout-arrow"></i>
                            </button>
                        </form>

                        <a href="{{ route('product.index') }}" class="cart-summary__continue-btn">
                            <i class="fas fa-arrow-left me-2"></i>
                            Lanjut Belanja
                        </a>

                        <div class="cart-summary__secure">
                            <i class="fas fa-lock"></i>
                            <span>Transaksi aman & terenkripsi</span>
                        </div>
                    </div>
                </div>

            </div>

        @else
            {{-- Empty state --}}
            <div class="cart-empty">
                <div class="cart-empty__icon-wrap">
                    <i class="fas fa-shopping-bag cart-empty__icon"></i>
                </div>
                <h3 class="cart-empty__title">Keranjang Masih Kosong</h3>
                <p class="cart-empty__desc">Belum ada produk yang ditambahkan. Yuk mulai belanja produk kesehatan terbaik!</p>
                <a href="{{ route('product.index') }}" class="cart-empty__btn">
                    <i class="fas fa-capsules me-2"></i>
                    Mulai Belanja
                </a>
            </div>
        @endif

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const resepFiles = {};

    // Upload resep
    document.querySelectorAll('.resep-upload').forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const itemId = this.dataset.itemId;
            if (!file) return;
            const formData = new FormData();
            formData.append('resep', file);
            formData.append('_token', '{{ csrf_token() }}');
            fetch('{{ route("checkout.uploadResep") }}', { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        resepFiles[itemId] = data.path;
                        Swal.fire({ icon: 'success', title: 'Resep diupload!', timer: 1500, showConfirmButton: false });
                    }
                })
                .catch(() => Swal.fire('Error', 'Gagal mengupload resep', 'error'));
        });
    });

    // Qty +
    document.querySelectorAll('.cart-qty__btn--plus').forEach(btn => {
        btn.addEventListener('click', () => {
            const form = btn.closest('.cart-qty__form');
            const input = form.querySelector('input[name="quantity"]');
            input.value = parseInt(input.value) + 1;
            updateSubtotal(input);
            submitQtyForm(form);
        });
    });

    // Qty -
    document.querySelectorAll('.cart-qty__btn--minus').forEach(btn => {
        btn.addEventListener('click', () => {
            const form = btn.closest('.cart-qty__form');
            const input = form.querySelector('input[name="quantity"]');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateSubtotal(input);
                submitQtyForm(form);
            }
        });
    });

    function submitQtyForm(form) {
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ quantity: form.querySelector('input[name="quantity"]').value })
        });
    }

    function updateSubtotal(input) {
        const cartItem = input.closest('.cart-item');
        const priceText = cartItem.querySelector('.cart-item__unit-price strong').innerText;
        const price = parseInt(priceText.replace(/\D/g, ''));
        const subtotal = price * parseInt(input.value);
        cartItem.querySelector('.subtotal-display').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
        const checkbox = cartItem.querySelector('.cart-checkbox');
        if (checkbox) checkbox.setAttribute('data-price', subtotal);
        updateTotalHarga();
    }

    function updateTotalHarga() {
        let total = 0;
        document.querySelectorAll('.cart-checkbox').forEach(cb => {
            if (cb.checked) total += parseInt(cb.getAttribute('data-price'));
        });
        document.getElementById('total-harga-display').innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    document.querySelectorAll('.cart-checkbox').forEach(cb => {
        cb.addEventListener('change', updateTotalHarga);
    });
    updateTotalHarga();

    // Checkout
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        e.preventDefault();

        // Check resep
        const kerasItems = document.querySelectorAll('.resep-upload[required]');
        let missingResep = false;
        kerasItems.forEach(input => {
            if (!resepFiles[input.dataset.itemId]) missingResep = true;
        });
        if (missingResep) {
            Swal.fire('Perhatian', 'Harap upload resep untuk obat keras terlebih dahulu', 'warning');
            return;
        }

        // Collect selected
        let selected = [];
        document.querySelectorAll('.cart-checkbox').forEach(cb => {
            if (cb.checked) {
                selected.push(cb.closest('.cart-item').querySelector('input[name="quantity"]').form.action.split('/').pop());
            }
        });
        document.getElementById('selected-products-input').value = selected.join(',');
        this.submit();
    });
});
</script>
@endpush

@endsection
@section('footer')
    @include('fe.footer')
@endsection