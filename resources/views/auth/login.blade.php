<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Medicare - Apotek Online Terpercaya">
    <title>Login — Medicare</title>

    <!-- Auth CSS (existing) -->
    <link rel="stylesheet" href="{{ asset('auth/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('auth/css/app-dark.css') }}" id="darkTheme" disabled>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS (load last to override) -->
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
</head>

<body class="light login-page-body">

    <div class="login-page">

        {{-- ===== Left Panel (branding) ===== --}}
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

                <h2 class="login-panel__tagline">Kesehatan Anda,<br>Prioritas Kami.</h2>
                <p class="login-panel__sub">Apotek online terpercaya dengan ribuan produk kesehatan berkualitas, pengiriman cepat, dan konsultasi apoteker gratis.</p>

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
                        <span class="login-panel__feat-icon"><i class="fas fa-headset"></i></span>
                        <span>Apoteker Online 24/7</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Right Panel (form) ===== --}}
        <div class="login-form-panel">
            <div class="login-form-wrap">

                {{-- Mobile logo --}}
                <a href="/" class="login-form-wrap__mobile-logo">
                    <span class="login-panel__logo-icon login-panel__logo-icon--sm">
                        <i class="fas fa-plus-square"></i>
                    </span>
                    <span class="login-panel__logo-text login-panel__logo-text--dark">Medi<span class="login-panel__logo-accent">care</span></span>
                </a>

                <div class="login-form-wrap__heading">
                    <h1 class="login-form-wrap__title">Selamat Datang</h1>
                    <p class="login-form-wrap__subtitle">Masuk ke akun Medicare Anda</p>
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

                <form action="{{ route('login-user') }}" method="POST" class="login-form">
                    @csrf

                    {{-- Email --}}
                    <div class="login-field">
                        <label class="login-field__label" for="inputEmail">Alamat Email</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-envelope"></i></span>
                            <input
                                type="email"
                                id="inputEmail"
                                name="email"
                                class="login-field__input"
                                placeholder="nama@email.com"
                                required
                                autofocus
                                value="{{ old('email') }}">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="login-field">
                        <label class="login-field__label" for="inputPassword">Password</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-lock"></i></span>
                            <input
                                type="password"
                                id="inputPassword"
                                name="password"
                                class="login-field__input login-field__input--password"
                                placeholder="Masukkan password"
                                required>
                            <button type="button" class="login-field__toggle-pw" id="togglePassword">
                                <i class="fas fa-eye" id="togglePwIcon"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Remember me --}}
                    <div class="login-remember">
                        <label class="login-remember__label">
                            <input type="checkbox" name="remember" class="login-remember__checkbox">
                            <span class="login-remember__custom"></span>
                            <span class="login-remember__text">Tetap masuk</span>
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="login-submit-btn">
                        {{-- <i class="fas fa-sign-in-alt me-2"></i> --}}
                        Masuk Sekarang
                    </button>
                </form>

                <div class="login-divider">
                    <span>atau</span>
                </div>

                <a href="{{ url('register') }}" class="login-register-btn">
                    <i class="fas fa-user-plus me-2"></i>
                    Buat Akun Baru
                </a>

                <p class="login-footer-text">
                    Dengan masuk, Anda menyetujui <a href="#">Syarat & Ketentuan</a> kami.
                </p>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/js/popper.min.js') }}"></script>
    <script src="{{ asset('auth/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auth/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('auth/js/apps.js') }}"></script>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const input = document.getElementById('inputPassword');
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