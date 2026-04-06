<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Medicare - Apotek Online Terpercaya">
    <title>Register — Medicare</title>
    <link rel="stylesheet" href="{{ asset('auth/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('auth/css/app-dark.css') }}" id="darkTheme" disabled>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                <p class="login-panel__sub">Akun khusus untuk Admin, Apoteker, Kasir, Karyawan, dan Staff internal Medicare.</p>
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
                <a href="/" class="login-form-wrap__mobile-logo">
                    <span class="login-panel__logo-icon login-panel__logo-icon--sm">
                        <i class="fas fa-plus-square"></i>
                    </span>
                    <span class="login-panel__logo-text login-panel__logo-text--dark">Medi<span class="login-panel__logo-accent">care</span></span>
                </a>
                <div class="login-form-wrap__heading">
                    <h1 class="login-form-wrap__title">Registrasi Akun Admin/Staff</h1>
                    <p class="login-form-wrap__subtitle">Buat akun khusus untuk Admin, Apoteker, Kasir, Karyawan, atau Staff internal Medicare</p>
                </div>
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
                <form action="{{ route('register-user') }}" method="POST" class="login-form">
                    @csrf
                    <div class="login-field">
                        <label class="login-field__label" for="Username">Username</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-user"></i></span>
                            <input type="text" id="Username" name="name" class="login-field__input" placeholder="Username" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="login-field">
                        <label class="login-field__label" for="inputEmail4">Email</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="inputEmail4" name="email" class="login-field__input" placeholder="Email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="login-field">
                        <label class="login-field__label" for="no_hp">No. HP</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-phone"></i></span>
                            <input type="text" id="no_hp" name="no_hp" class="login-field__input" placeholder="No. HP" value="{{ old('no_hp') }}" required>
                        </div>
                    </div>
                    <div class="login-field">
                        <label class="login-field__label" for="jabatan">Role</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-user-tag"></i></span>
                            <select class="login-field__input" id="jabatan" name="jabatan" required>
                                <option value="" disabled selected>Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="karyawan">Karyawan</option>
                                <option value="apoteker">Apoteker</option>
                                <option value="pemilik">Pemilik</option>
                                <option value="kasir">Kasir</option>
                                <option value="kurir">Kurir</option>
                            </select>
                        </div>
                    </div>
                    <div class="login-field">
                        <label class="login-field__label" for="inputPassword5">Password</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-lock"></i></span>
                            <input type="password" id="inputPassword5" name="password" class="login-field__input login-field__input--password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="login-field">
                        <label class="login-field__label" for="password_confirmed">Konfirmasi Password</label>
                        <div class="login-field__input-wrap">
                            <span class="login-field__icon"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password_confirmed" name="password_confirmation" class="login-field__input login-field__input--password" placeholder="Konfirmasi Password" required>
                        </div>
                    </div>
                    <div class="mb-3 mt-2">
                        <p class="small text-muted mb-1">Password minimal 8 karakter, mengandung angka & karakter spesial.</p>
                    </div>
                    <button type="submit" class="login-submit-btn">Daftar Akun</button>
                </form>
                <div class="login-divider">
                    <span>atau</span>
                </div>
                <a href="{{ url('login') }}" class="login-register-btn">Login Akun yang Sudah Ada</a>
                <p class="login-footer-text mt-3">
                    Hanya untuk akun internal (Admin, Apoteker, Kasir, Karyawan).<br>
                    Dengan mendaftar, Anda menyetujui <a href="#">Syarat & Ketentuan</a> Medicare.
                </p>
            </div>
        </div>
    </div>
    <script src="{{ asset('auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/js/popper.min.js') }}"></script>
    <script src="{{ asset('auth/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auth/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('auth/js/apps.js') }}"></script>
</body>
</html>
