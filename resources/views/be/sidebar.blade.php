<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ asset('fe/img/default-profile.jpg') }}">
            </div>
            <div class="info">
                @if (session('loginId'))
                    <?php
                    $user = \App\Models\User::find(session('loginId'));
                    ?>
                    <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ $user->name }}
                            <span class="user-level">{{ $user->jabatan }}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                @endif
                {{-- <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                    <ul class="nav">
                        <li>
                            <a href="#profile">
                                <span class="link-collapse">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#edit">
                                <span class="link-collapse">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="link-collapse">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
        <ul class="nav">
            @if (auth()->check() && (auth()->user()->jabatan == 'admin' || auth()->user()->jabatan == 'pemilik'))
                <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="la la-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
            @endif

            @if (auth()->check() && auth()->user()->jabatan == 'admin')
                <li class="nav-item {{ Request::is('manage-user*') ? 'active' : '' }}">
                    <a href="{{ route('manage-user.index') }}">
                        <i class="fa-solid fa-user-tie"></i>
                        <p>Management User</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('data-pelanggan*') ? 'active' : '' }}">
                    <a href="{{ route('data-pelanggan.index') }}">
                        <i class="la la-users"></i>
                        <p>Data Pelanggan</p>
                    </a>
                </li>
            @endif

            @if (auth()->check() && auth()->user()->jabatan == 'apoteker')
                <li class="nav-item {{ Request::is('produk*') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#produkMenu">
                        <i class="la la-medkit"></i>
                        <p>Produk</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="produkMenu">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ Request::is('obat*') ? 'active' : '' }}">
                                <a href="{{ route('obat.index') }}">
                                    <span class="sub-item">Daftar Obat</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('jenis-obat*') ? 'active' : '' }}">
                                <a href="{{ route('jenis-obat.index') }}">
                                    <span class="sub-item">Jenis Obat</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::is('distributor*') ? 'active' : '' }}">
                    <a href="{{ route('distributor.index') }}">
                        <i class="la la-truck"></i>
                        <p>Distributor</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('pembelian.index') }}">
                        <i class="la la-shopping-cart"></i>
                        <p>Pembelian</p>
                    </a>
                </li>
            @endif

            @if (auth()->check() && auth()->user()->jabatan == 'kasir')
                <li class="nav-item {{ Request::is('obat*') ? 'active' : '' }}">
                    <a href="{{ route('obat.index') }}">
                        <i class="la la-shopping-cart"></i>
                        <p>Daftar Produk</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('penjualan*') ? 'active' : '' }}">
                    <a href="{{ route('penjualan.index') }}">
                        <i class="la la-money"></i>
                        <p>Penjualan</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('data-pemasukan*') ? 'active' : '' }}">
                    <a href="{{ route('data-pemasukan.index') }}">
                        <i class="la la-chart-line"></i>
                        <p>Data Pemasukan</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('metode-bayar*') ? 'active' : '' }}">
                    <a href="{{ route('metode-bayar.index') }}">
                        <i class="la la-credit-card"></i>
                        <p>Metode Pembayaran</p>
                    </a>
                </li>
            @endif

            @if (auth()->check() && auth()->user()->jabatan == 'karyawan')
                <li class="nav-item">
                    <a href="{{ route('pengiriman.index')}}">
                        <i class="la la-truck"></i>
                        <p>Pengiriman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('jenis-pengiriman.index')}}">
                        <i class="la la-truck"></i>
                        <p>Jenis Pengiriman</p>
                    </a>
                </li>
            @endif

            @if (auth()->check() && auth()->user()->jabatan == 'kurir')
                <li class="nav-item">
                    <a href="{{ route('kurir.index')}}">
                        <i class="la la-truck"></i>
                        <p>Pengiriman</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
