@extends('fe.master')
@section('navbar')
    @include('fe.navbar')
@endsection

@section('checkout')

<!-- Hero Section Checkout -->
<style>
    .checkout-hero {
        background: linear-gradient(90deg, #e0f7fa 60%, #fff 100%);
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(13,202,240,0.08);
        padding: 2.5rem 2rem 2rem 2rem;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
        font-family: 'Montserrat', 'Poppins', Arial, sans-serif;
    }
    .checkout-hero-img {
        width: 120px;
        height: 120px;
        object-fit: contain;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 2px 12px rgba(13,202,240,0.10);
        margin-right: 1.5rem;
    }
    .checkout-hero-content h1 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #0dcaf0;
        margin-bottom: 0.5rem;
        font-family: 'Montserrat', 'Poppins', Arial, sans-serif;
    }
    .checkout-hero-content p {
        font-size: 1.1rem;
        color: #444;
        margin-bottom: 0.5rem;
        font-family: 'Montserrat', 'Poppins', Arial, sans-serif;
    }
    .checkout-hero-content .hero-highlight {
        color: #0dcaf0;
        font-weight: 600;
    }
    @media (max-width: 767px) {
        .checkout-hero {
            flex-direction: column;
            text-align: center;
            padding: 1.5rem 1rem;
        }
        .checkout-hero-img {
            margin: 0 auto 1rem auto;
        }
    }
    .form-select, .btn {
        height: 45px;
        font-family: 'Montserrat', 'Poppins', Arial, sans-serif;
    }
    .form-select, .btn, .card, .card-header {
        font-family: 'Montserrat', 'Poppins', Arial, sans-serif;
    }
    .form-select, .btn, .card, .card-header, .fw-bold, h5, h6 {
        letter-spacing: 0.01em;
    }
    .form-select, .btn, .card, .card-header {
        border-radius: 15px;
    }
    .form-select, .btn {
        border: 2px solid #0dcaf0;
    }
    .form-select:focus {
        border-color: #0dcaf0;
        box-shadow: 0 0 0 0.2rem rgba(13,202,240,0.15);
    }
    .card-header {
        background-color: #0dcaf0;
        color: white;
        border-radius: 15px 15px 0 0 !important;
        font-family: 'Montserrat', 'Poppins', Arial, sans-serif;
        font-weight: 700;
        font-size: 1.2rem;
    }
    .btn-primary, .btn-info, .btn-success {
        background-color: #0dcaf0 !important;
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-family: 'Montserrat', 'Poppins', Arial, sans-serif;
        font-weight: 600;
        font-size: 1.1rem;
    }
    .btn-primary:hover, .btn-info:hover, .btn-success:hover {
        background-color: #0bbcd6 !important;
    }
    .text-primary {
        color: #0dcaf0 !important;
    }
    .fw-bold, h5, h6 {
        font-family: 'Montserrat', 'Poppins', Arial, sans-serif;
    }
</style>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap" rel="stylesheet">

<div class="container py-4">
    <div class="checkout-hero">
        <img src="{{ asset('fe/img/checkout-hero.png') }}" alt="Checkout" class="checkout-hero-img"
            onerror="this.src='https://img.icons8.com/fluency/96/checkout.png'">
        <div class="checkout-hero-content">
            <h1><i class="fa fa-credit-card hero-highlight"></i> Checkout</h1>
            <p>
                Pilih <span class="hero-highlight">metode pembayaran</span> dan <span class="hero-highlight">pengiriman</span> favoritmu.<br>
                Transaksi <span class="hero-highlight">aman</span> dan <span class="hero-highlight">proses cepat</span> di Apotek Medicare!
            </p>
            <p>
                <i class="fa fa-shield-heart text-info"></i> Aman & Terpercaya &nbsp; | &nbsp;
                <i class="fa fa-truck-fast text-info"></i> Pengiriman Seluruh Indonesia
            </p>
        </div>
    </div>
</div>
<!-- End Hero Section Checkout -->

<div class="container py-5">
    <div class="row g-4">
        <!-- Form Pengiriman & Pembayaran -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <select class="form-select rounded-pill border-info" name="jenis_pengiriman" id="jenis_pengiriman_select" required>
                        <option value="">Pilih Jenis Pengiriman</option>
                        @foreach($jenis_pengirimans as $jp)
                            <option value="{{ $jp->id }}" data-cost="{{ $jp->ongkos_kirim ?? 0 }}">
                                {{ $jp->nama_ekspedisi }} - {{ $jp->jenis_kirim }} (Rp {{ number_format($jp->ongkos_kirim ?? 0, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-select rounded-pill border-info" name="id_metode_bayar" id="id_metode_bayar_select" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        @foreach($metode_bayars as $mb)
                            <option value="{{ $mb->id }}">
                                {{ $mb->metode_pembayaran }} - {{ $mb->tempat_bayar }}
                                @if($mb->no_rekening)
                                    ({{ $mb->no_rekening }})
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Kolom kiri untuk Produk yang Dibeli -->
        <div class="col-md-8">
            <form id="produk-resep-form" enctype="multipart/form-data">
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Produk yang Dibeli</h5>
                    </div>
                    <div class="card-body p-0">
                        @forelse($checkout_items as $index => $item)
                        <div class="p-3 border-bottom">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <img src="{{ asset('storage/' . $item['image']) }}" 
                                         class="img-fluid rounded" alt="Product"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                                <div class="col-6">
                                    <div>
                                        <h6 class="mb-1">{{ $item['name'] }}</h6>
                                        <p class="text-muted mb-0">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <span class="fw-bold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="p-3 text-center text-muted">
                            Tidak ada produk yang di checkout
                        </div>
                        @endforelse
                    </div>
                </div>
            </form>
        </div>

        <!-- Kolom kanan untuk Ringkasan Belanja -->
        <div class="col-md-4">
            <form id="order-form" action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Ringkasan Belanja</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Harga ({{count($checkout_items)}} barang)</span>
                            <span>Rp {{ number_format($total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Kirim</span>
                            <span id="ongkir">Rp 0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="fw-bold mb-0">Total Bayar</h6>
                            <h6 class="fw-bold mb-0" id="total">Rp {{ number_format($total_price, 0, ',', '.') }}</h6>
                        </div>
                        <div class="card border-0 shadow-sm rounded-3 mb-4">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Upload Foto Resep</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="url_resep" id="url_resep" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="jenis_pengiriman" id="input-jenis-pengiriman">
                        <input type="hidden" name="id_metode_bayar" id="input-metode-bayar"> 
                        <input type="hidden" name="ongkir" id="input-ongkir">
                        <input type="hidden" name="total_bayar" id="input-total-bayar">
                        <input type="hidden" name="produk" id="input-produk">
                        <input type="hidden" id="has-obat-keras" value="{{ collect($checkout_items ?? [])->where('is_keras', true)->count() > 0 ? '1' : '0' }}">
                        <button type="submit" class="btn btn-info w-100 py-2" id="pay-button">
                            Buat Pesanan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const orderForm = document.getElementById('order-form');
    const jenisPengirimanSelect = document.getElementById('jenis_pengiriman_select');
    const metodeBayarSelect = document.getElementById('id_metode_bayar_select');
    const ongkirSpan = document.getElementById('ongkir');
    const totalSpan = document.getElementById('total');
    let totalPrice = {{ $total_price }};

    // Update ongkir when shipping method changes
    jenisPengirimanSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const ongkir = parseInt(selectedOption.dataset.cost) || 0;
        const totalBayar = totalPrice + ongkir;
        
        ongkirSpan.textContent = `Rp ${ongkir.toLocaleString('id-ID')}`;
        totalSpan.textContent = `Rp ${totalBayar.toLocaleString('id-ID')}`;
    });

    orderForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!jenisPengirimanSelect.value) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Silakan pilih metode pengiriman!'
            });
            return;
        }

        if (!metodeBayarSelect.value) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Silakan pilih metode pembayaran!'
            });
            return;
        }

        // Set form input values before submit
        document.getElementById('input-jenis-pengiriman').value = jenisPengirimanSelect.value;
        document.getElementById('input-metode-bayar').value = metodeBayarSelect.value;
        
        const selectedOption = jenisPengirimanSelect.options[jenisPengirimanSelect.selectedIndex];
        const ongkir = parseInt(selectedOption.dataset.cost) || 0;
        document.getElementById('input-ongkir').value = ongkir;
        document.getElementById('input-total-bayar').value = totalPrice + ongkir;

        let produk = [];
        @foreach($checkout_items as $item)
            produk.push({
                id: {{ $item['id'] }},
                name: "{{ $item['name'] }}",
                qty: {{ $item['quantity'] }},
                price: {{ $item['price'] }},
                image: "{{ $item['image'] }}"
            });
        @endforeach
        document.getElementById('input-produk').value = JSON.stringify(produk);

        this.submit();
    });
});
</script>
@endsection

@section('footer')
    @include('fe.footer')
@endsection
