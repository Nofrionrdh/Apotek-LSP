@extends('fe.master')
@section('navbar')
    @include('fe.navbar')
@endsection
@section('about')

{{-- ===== Page Hero Header ===== --}}
<div class="about-hero">
    <div class="about-hero__bg-orb about-hero__bg-orb--1"></div>
    <div class="about-hero__bg-orb about-hero__bg-orb--2"></div>
    <div class="about-hero__grid"></div>
    <div class="container position-relative" style="z-index:2;">
        <div class="about-hero__content">
            <div class="about-hero__eyebrow">
                <span class="about-hero__eyebrow-dot"></span>
                Mengenal Kami
            </div>
            <h1 class="about-hero__title">About <span class="about-hero__title-accent">Us</span></h1>
            <nav aria-label="breadcrumb">
                <ol class="about-hero__breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><i class="fas fa-chevron-right"></i></li>
                    <li class="about-hero__breadcrumb-active">About Us</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

{{-- ===== Main About Section ===== --}}
<div class="about-main">
    <div class="container">
        <div class="about-main__grid">

            {{-- Left: Image block --}}
            <div class="about-img-block">
                <div class="about-img-block__frame">
                    <img class="about-img-block__photo" src="{{ asset('fe/img/obat-about.jpg') }}" alt="Medicare Apotek">
                    <div class="about-img-block__glow"></div>
                </div>
                {{-- Floating stat cards --}}
                <div class="about-stat-card about-stat-card--1">
                    <div class="about-stat-card__icon"><i class="fas fa-pills"></i></div>
                    <div class="about-stat-card__body">
                        <div class="about-stat-card__num">2.000+</div>
                        <div class="about-stat-card__label">Jenis Produk</div>
                    </div>
                </div>
                <div class="about-stat-card about-stat-card--2">
                    <div class="about-stat-card__icon"><i class="fas fa-user-friends"></i></div>
                    <div class="about-stat-card__body">
                        <div class="about-stat-card__num">50K+</div>
                        <div class="about-stat-card__label">Pelanggan Puas</div>
                    </div>
                </div>
            </div>

            {{-- Right: Content --}}
            <div class="about-content">
                <div class="about-content__eyebrow">
                    <span class="about-content__eyebrow-dot"></span>
                    Tentang Medicare
                </div>
                <h2 class="about-content__title">
                    Pelayanan Kesehatan <br>
                    <span class="about-content__title-accent">Terbaik Untuk Anda</span>
                </h2>
                <p class="about-content__desc">
                    Kami menyediakan berbagai macam obat-obatan lengkap, produk kesehatan terpercaya, serta pelayanan cepat dan ramah untuk memenuhi kebutuhan kesehatan Anda sehari-hari.
                </p>

                {{-- Checklist --}}
                <ul class="about-checklist">
                    <li class="about-checklist__item">
                        <span class="about-checklist__icon"><i class="fas fa-check"></i></span>
                        <div>
                            <div class="about-checklist__title">Obat Lengkap & Terpercaya</div>
                            <div class="about-checklist__sub">Generik dan bermerek tersedia dengan kualitas terjamin.</div>
                        </div>
                    </li>
                    <li class="about-checklist__item">
                        <span class="about-checklist__icon"><i class="fas fa-check"></i></span>
                        <div>
                            <div class="about-checklist__title">Layanan Antar ke Rumah</div>
                            <div class="about-checklist__sub">Pengiriman cepat ke seluruh wilayah, langsung di depan pintu.</div>
                        </div>
                    </li>
                    <li class="about-checklist__item">
                        <span class="about-checklist__icon"><i class="fas fa-check"></i></span>
                        <div>
                            <div class="about-checklist__title">Belanja Mudah & Praktis</div>
                            <div class="about-checklist__sub">Tim kami siap membantu Anda dengan pelayanan yang cepat dan ramah.</div>
                        </div>
                    </li>
                </ul>

                <a class="about-cta-btn" href="{{ route('product.index') }}">
                    <i class="fas fa-capsules me-2"></i>
                    Lihat Semua Produk
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ===== Why Choose Us ===== --}}
<div class="about-features">
    <div class="container">
        <div class="about-features__header">
            <div class="about-features__eyebrow">
                <span class="about-features__eyebrow-dot"></span>
                Keunggulan Kami
            </div>
            <h2 class="about-features__title">Mengapa Memilih <span class="about-features__title-accent">Medicare?</span></h2>
        </div>
        <div class="about-features__grid">
            <div class="about-feat-card">
                <div class="about-feat-card__icon-wrap">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="about-feat-card__title">100% Asli & Aman</h3>
                <p class="about-feat-card__desc">Semua produk bersumber dari distributor resmi dan telah tersertifikasi BPOM.</p>
            </div>
            <div class="about-feat-card">
                <div class="about-feat-card__icon-wrap">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h3 class="about-feat-card__title">Pengiriman Cepat</h3>
                <p class="about-feat-card__desc">Estimasi pengiriman same-day untuk area kota dan 1-3 hari ke seluruh Indonesia.</p>
            </div>
            <div class="about-feat-card">
                <div class="about-feat-card__icon-wrap">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h3 class="about-feat-card__title">Harga Terjangkau</h3>
                <p class="about-feat-card__desc">Harga kompetitif dengan promo menarik setiap minggu untuk pelanggan setia.</p>
            </div>
            <div class="about-feat-card">
                <div class="about-feat-card__icon-wrap">
                    <i class="fa-solid fa-thumbs-up"></i>
                </div>
                <h3 class="about-feat-card__title">Pelayanan Terbaik untuk Anda</h3>
                <p class="about-feat-card__desc">Kami berkomitmen memberikan pelayanan yang nyaman dan terpercaya.</p>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
    @include('fe.footer')
@endsection