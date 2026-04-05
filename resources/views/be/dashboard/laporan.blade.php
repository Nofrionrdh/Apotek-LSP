@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Laporan Dashboard</h4>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>User</th>
                            <td>{{ $totalUser }}</td>
                        </tr>
                        <tr>
                            <th>Pelanggan</th>
                            <td>{{ $totalPelanggan }}</td>
                        </tr>
                        <tr>
                            <th>Penjualan</th>
                            <td>{{ $totalPenjualan }}</td>
                        </tr>
                        <tr>
                            <th>Pembelian</th>
                            <td>{{ $totalPembelian }}</td>
                        </tr>
                        <tr>
                            <th>Produk</th>
                            <td>{{ $totalObat }}</td>
                        </tr>
                        <tr>
                            <th>Distributor</th>
                            <td>{{ $totalDistributor }}</td>
                        </tr>
                        <tr>
                            <th>Pengiriman</th>
                            <td>{{ $totalPengiriman }}</td>
                        </tr>
                        <tr>
                            <th>Total Pengeluaran</th>
                            <td>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Total Penghasilan</th>
                            <td>Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                    @if(auth()->check() && (auth()->user()->jabatan == 'admin' || auth()->user()->jabatan == 'pemilik'))
                        <a href="{{ route('dashboard.laporan.pdf') }}" class="btn btn-primary" target="_blank">
                            Download PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
