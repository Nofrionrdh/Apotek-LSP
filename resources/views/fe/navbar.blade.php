<div class="navbar-wrapper">
    <nav class="navbar-nav-main navbar-expand-lg">
        <!-- Logo -->
        <a href="/" class="navbar-logo">
            <span class="navbar-logo__icon">
                <i class="fas fa-plus-square"></i>
            </span>
            <span class="navbar-logo__text">Medi<span class="navbar-logo__accent">care</span></span>
        </a>

        <!-- Mobile toggler -->
        <button class="navbar-toggler-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar"></span>
            <span class="navbar-toggler-bar"></span>
            <span class="navbar-toggler-bar"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-links">
                <li class="navbar-links__item">
                    <a href="/" class="navbar-links__anchor {{ request()->is('/') ? 'is-active' : '' }}">Home</a>
                </li>
                <li class="navbar-links__item">
                    <a href="/about" class="navbar-links__anchor {{ request()->is('about') ? 'is-active' : '' }}">About Us</a>
                </li>
                <li class="navbar-links__item navbar-links__item--dropdown">
                    <a href="#" class="navbar-links__anchor navbar-links__anchor--dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                        <i class="fas fa-chevron-down navbar-chevron"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('product.index') }}" class="navbar-dropdown__item">
                                <span class="navbar-dropdown__icon">
                                    <i class="fas fa-capsules"></i>
                                </span>
                                All Products
                            </a>
                        </li>
                        @if(session('pelanggan'))
                        <li>
                            <a href="{{ route('checkout.index') }}" class="navbar-dropdown__item">
                                <span class="navbar-dropdown__icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </span>
                                Products Checkout
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="navbar-links__item">
                    <a href="/contact" class="navbar-links__anchor {{ request()->is('contact') ? 'is-active' : '' }}">Contact Us</a>
                </li>
            </ul>

            <!-- Action icons -->
            <div class="navbar-actions">
                <!-- Cart -->
                <a class="navbar-action-btn" href="{{ route('cart.index') }}">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="navbar-action-btn__label">Keranjang</span>
                </a>

                <!-- Orders -->
                <a class="navbar-action-btn" href="{{ route('pemesanan.index') }}">
                    <i class="fas fa-file-invoice"></i>
                    <span class="navbar-action-btn__label">Pesanan</span>
                </a>

                <!-- Profile dropdown -->
                <div class="navbar-profile dropdown" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="navbar-profile__avatar">
                        <img
                            src="{{ session('pelanggan') && session('pelanggan')->foto ? asset('storage/' . session('pelanggan')->foto) : asset('fe/img/default-profile.jpg') }}"
                            alt="Profile">
                    </div>
                    @if(session('pelanggan'))
                        <span class="navbar-profile__online-dot"></span>
                    @endif
                </div>

                <ul class="dropdown-menu dropdown-menu-end navbar-profile-menu" aria-labelledby="profileDropdown">
                    @if(session('pelanggan'))
                        <li class="navbar-profile-menu__header">
                            <img
                                src="{{ session('pelanggan')->foto ? asset('storage/' . session('pelanggan')->foto) : asset('fe/img/default-profile.jpg') }}"
                                alt="Profile" class="navbar-profile-menu__avatar">
                            <div class="navbar-profile-menu__name">{{ session('pelanggan')->nama_pelanggan }}</div>
                            <div class="navbar-profile-menu__email">{{ session('pelanggan')->email }}</div>
                        </li>
                        <li><hr class="navbar-profile-menu__divider"></li>
                        <li>
                            <a class="navbar-profile-menu__item" href="{{ route('profile.index') }}">
                                <i class="fas fa-user"></i>
                                Profile
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('pelanggan.logout') }}" method="POST" class="m-0">
                                @csrf
                                <button class="navbar-profile-menu__item navbar-profile-menu__item--danger" type="submit">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a class="navbar-profile-menu__item" href="{{ route('pelanggan.register') }}">
                                <i class="fas fa-user-plus"></i>
                                Buat Akun
                            </a>
                        </li>
                        <li>
                            <a class="navbar-profile-menu__item" href="{{ route('pelanggan.login') }}">
                                <i class="fas fa-sign-in-alt"></i>
                                Login
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>