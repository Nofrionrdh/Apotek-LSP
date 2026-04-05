@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Dashboard</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-stats card-warning">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-users"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">User</p>
                                        <h4 class="card-title">{{ $totalUser }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats card-success">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-user"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Pelanggan</p>
                                        <h4 class="card-title">{{ $totalPelanggan }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats card-info">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-bar-chart"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Penjualan</p>
                                        <h4 class="card-title">{{ $totalPenjualan }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats card-primary">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Pembelian</p>
                                        <h4 class="card-title">{{ $totalPembelian }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats card-success">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-medkit"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Produk</p>
                                        <h4 class="card-title">{{ $totalObat }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats card-warning">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-truck"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Distributor</p>
                                        <h4 class="card-title">{{ $totalDistributor }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats card-info">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-truck"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Pengiriman</p>
                                        <h4 class="card-title">{{ $totalPengiriman }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @if(auth()->check() && auth()->user()->jabatan == 'admin')
                <div class="col-md-3">
                    <div class="card card-stats card-primary">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-money"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Penjualan Saya</p>
                                        <h4 class="card-title">{{ $totalPenjualanUser }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif --}}
                <div class="col-md-3">
                    <div class="card card-stats card-danger">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-money"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Total Pengeluaran</p>
                                        <h4 class="card-title">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats card-success">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="la la-money"></i>
                                    </div>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="numbers">
                                        <p class="card-category">Total Penghasilan</p>
                                        <h4 class="card-title">Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(auth()->check() && (auth()->user()->jabatan == 'admin' || auth()->user()->jabatan == 'pemilik'))
                <a href="{{ route('dashboard.export.pdf') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                
                <!-- Opsi: Tambahkan form filter periode jika diperlukan -->
                <form action="{{ route('dashboard.export.pdf') }}" method="GET" class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label>Dari Tanggal</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="fas fa-filter"></i> Filter & Export
                        </button>
                    </div>
                </form>
            @endif
            {{-- <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Task</h4>
                                <p class="card-category">Complete</p>
                            </div>
                            <div class="card-body">
                                <div id="task-complete" class="chart-circle mt-4 mb-3"></div>
                            </div>
                            <div class="card-footer">
                                <div class="legend"><i class="la la-circle text-primary"></i> Completed</div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <nav class="pull-left">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.themekita.com">
                            ThemeKita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Help
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://themewagon.com/license/#free-item">
                            Licenses
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright ml-auto">
                2018, made with <i class="la la-heart heart text-danger"></i> by <a
                    href="http://www.themekita.com">ThemeKita</a>
            </div>
        </div>
    </footer>
</div>

@endsection