<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Medicare - Apotek Online Terpercaya">
    <title>Daftar Akun — Medicare</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS (berisi login- & reg- classes) -->
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
</head>

<body class="login-page-body">

    <div class="login-page">

        {{-- ===== Left Panel (sama persis dengan login) ===== --}}
        <div class="login-panel">
            <div class="login-panel__bg-orb login-panel__bg-orb--1"></div>
            <div class="login-panel__bg-orb login-panel__bg-orb--2"></div>
            <div class="login-panel__grid"></div>

            <div class="login-panel__content">
                <a href="/" class="login-panel__logo">
                    <span class="login-panel__logo-icon">
                        <i class="fas fa-plus-square"></i>
                    </span>
                    <span class="login-panel__logo-text">Medi<span class="login-panel__logo-accent">care</span></span>
                </a>

                <h2 class="login-panel__tagline">Bergabung &<br>Mulai Berbelanja.</h2>
                <p class="login-panel__sub">Daftarkan diri Anda sekarang dan nikmati kemudahan berbelanja produk kesehatan terpercaya kapan saja dan di mana saja.</p>

                <div class="login-panel__stats">
                    <div class="login-panel__stat">
                        <div class="login-panel__stat-num">50K+</div>
                        <div class="login-panel__stat-label">Pelanggan</div>
                    </div>
                    <div class="login-panel__stat-divider"></div>
                    <div class="login-panel__stat">
                        <div class="login-panel__stat-num">2.000+</div>
                        <div class="login-panel__stat-label">Produk</div>
                    </div>
                    <div class="login-panel__stat-divider"></div>
                    <div class="login-panel__stat">
                        <div class="login-panel__stat-num">4.9★</div>
                        <div class="login-panel__stat-label">Rating</div>
                    </div>
                </div>

                <div class="login-panel__features">
                    <div class="login-panel__feat">
                        <span class="login-panel__feat-icon"><i class="fas fa-shield-alt"></i></span>
                        <span>Produk 100% Asli & BPOM</span>
                    </div>
                    <div class="login-panel__feat">
                        <span class="login-panel__feat-icon"><i class="fas fa-shipping-fast"></i></span>
                        <span>Pengiriman Same-Day</span>
                    </div>
                    <div class="login-panel__feat">
                        <span class="login-panel__feat-icon"><i class="fas fa-gift"></i></span>
                        <span>Promo Eksklusif Member Baru</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Right Panel (form register) ===== --}}
        <div class="login-form-panel">
            <div class="login-form-wrap reg-form-wrap">

                {{-- Mobile logo --}}
                <a href="/" class="login-form-wrap__mobile-logo">
                    <span class="login-panel__logo-icon login-panel__logo-icon--sm">
                        <i class="fas fa-plus-square"></i>
                    </span>
                    <span class="login-panel__logo-text login-panel__logo-text--dark">Medi<span class="login-panel__logo-accent">care</span></span>
                </a>

                <div class="login-form-wrap__heading">
                    <h1 class="login-form-wrap__title">Buat Akun Baru</h1>
                    <p class="login-form-wrap__subtitle">Isi data diri Anda untuk mulai berbelanja</p>
                </div>

                {{-- Error alert --}}
                @if ($errors->any())
                    <div class="login-alert">
                        <i class="fas fa-exclamation-circle login-alert__icon"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('pelanggan.register.submit') }}" class="login-form reg-form">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="login-field">
                        <label class="login-field__label" for="nama_pelanggan">Nama Lengkap</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-user"></i></span>
                            <input
                                type="text"
                                id="nama_pelanggan"
                                name="nama_pelanggan"
                                class="login-field__input"
                                placeholder="Nama lengkap Anda"
                                required
                                value="{{ old('nama_pelanggan') }}">
                        </div>
                        @error('nama_pelanggan')
                            <div class="reg-field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="login-field">
                        <label class="login-field__label" for="email">Alamat Email</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-envelope"></i></span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="login-field__input"
                                placeholder="nama@email.com"
                                required
                                value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <div class="reg-field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- No. Telepon --}}
                    <div class="login-field">
                        <label class="login-field__label" for="no_telp">No. Telepon</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-phone"></i></span>
                            <input
                                type="text"
                                id="no_telp"
                                name="no_telp"
                                class="login-field__input"
                                placeholder="08xxxxxxxxxx"
                                required
                                value="{{ old('no_telp') }}">
                        </div>
                        @error('no_telp')
                            <div class="reg-field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="login-field">
                        <label class="login-field__label" for="katakunci">Password</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-lock"></i></span>
                            <input
                                type="password"
                                id="katakunci"
                                name="katakunci"
                                class="login-field__input login-field__input--password"
                                placeholder="Minimal 8 karakter"
                                required>
                            <button type="button" class="login-field__toggle-pw" id="togglePassword">
                                <i class="fas fa-eye" id="togglePwIcon"></i>
                            </button>
                        </div>
                        @error('katakunci')
                            <div class="reg-field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="login-submit-btn reg-submit-btn">
                        {{-- <i class="fas fa-user-plus me-2"></i> --}}
                        Daftar Sekarang
                    </button>
                </form>

                <div class="login-divider">
                    <span>sudah punya akun?</span>
                </div>

                <a href="{{ route('pelanggan.login') }}" class="login-register-btn">
                    {{-- <i class="fas fa-sign-in-alt me-2"></i> --}}
                    Masuk ke Akun Saya
                </a>

                <p class="login-footer-text">
                    Dengan mendaftar, Anda menyetujui <a href="#">Syarat & Ketentuan</a> Medicare.
                </p>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const input = document.getElementById('katakunci');
            const icon = document.getElementById('togglePwIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>
</html>