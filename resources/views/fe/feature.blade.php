<section class="feat-section" id="feature">
    <div class="container">

        {{-- Header --}}
        <div class="feat-header">
            <div class="feat-header__eyebrow">
                <span class="feat-header__eyebrow-dot"></span>
                Layanan Kami
            </div>
            <h2 class="feat-header__title">Kenapa Pilih <span class="feat-header__title-accent">Medicare?</span></h2>
            <p class="feat-header__desc">Kami menyediakan layanan kesehatan terpercaya untuk kebutuhan medis Anda, mulai dari pemilihan obat hingga pengiriman langsung ke rumah.</p>
        </div>

        {{-- Cards --}}
        <div class="feat-grid">

            {{-- Card 1: Produk Lengkap & Terjamin --}}
            <div class="feat-card">
                <div class="feat-card__icon-wrap">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feat-card__title">Produk Lengkap & Terjamin</h3>
                <p class="feat-card__desc">Ribuan pilihan obat generik dan bermerek, semua tersertifikasi BPOM dan bersumber dari distributor resmi terpercaya.</p>
                <a class="feat-card__link" href="{{ route('product.index') }}">
                    Lihat Produk
                    <i class="fas fa-arrow-right feat-card__link-arrow"></i>
                </a>
            </div>

            {{-- Card 2: Obat Sesuai Kebutuhan --}}
            <div class="feat-card feat-card--highlighted">
                <div class="feat-card__icon-wrap">
                    <i class="fas fa-pills"></i>
                </div>
                <h3 class="feat-card__title">Obat Sesuai Kebutuhan</h3>
                <p class="feat-card__desc">Tersedia berbagai macam obat sesuai resep dokter maupun kebutuhan sehari-hari dengan harga terjangkau dan stok selalu tersedia.</p>
                <a class="feat-card__link" href="{{ route('product.index') }}">
                    Lihat Produk
                    <i class="fas fa-arrow-right feat-card__link-arrow"></i>
                </a>
            </div>

            {{-- Card 3: Layanan Antar Obat --}}
            <div class="feat-card">
                <div class="feat-card__icon-wrap">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h3 class="feat-card__title">Layanan Antar ke Rumah</h3>
                <p class="feat-card__desc">Kami antar obat langsung ke depan pintu Anda dengan cepat dan aman. Same-day delivery untuk area kota, 1–3 hari ke seluruh Indonesia.</p>
                <a class="feat-card__link" href="{{ route('contact.index') }}">
                    Info Pengiriman
                    <i class="fas fa-arrow-right feat-card__link-arrow"></i>
                </a>
            </div>

        </div>
    </div>
</section>