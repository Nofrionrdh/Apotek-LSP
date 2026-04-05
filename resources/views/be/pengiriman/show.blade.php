{{-- filepath: c:\xampp\htdocs\apotek-lsp\resources\views\be\pengiriman\show.blade.php --}}
@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('main-content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detail Pengiriman</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>No Invoice</th>
                    <td>{{ $pengiriman->no_invoice }}</td>
                </tr>
                <tr>
                    <th>Penjualan</th>
                    <td>{{ $pengiriman->penjualan->no_transaksi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kirim</th>
                    <td>{{ $pengiriman->tgl_kirim }}</td>
                </tr>
                <tr>
                    <th>Tanggal Tiba</th>
                    <td>{{ $pengiriman->tgl_tiba }}</td>
                </tr>
                <tr>
                    <th>Status Kirim</th>
                    <td>
                        <span class="badge {{ $pengiriman->status_kirim == 'Sedang Dikirim' ? 'bg-warning' : 'bg-success' }}">
                            {{ $pengiriman->status_kirim }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Nama Kurir</th>
                    <td>{{ $pengiriman->nama_kurir }}</td>
                </tr>
                <tr>
                    <th>Telpon Kurir</th>
                    <td>{{ $pengiriman->telpon_kurir }}</td>
                </tr>
                <tr>
                    <th>Bukti Foto</th>
                    <td>
                        @if($pengiriman->bukti_foto)
                            <img src="{{ asset('storage/'.$pengiriman->bukti_foto) }}" alt="Bukti" width="120">
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $pengiriman->keterangan }}</td>
                </tr>
            </table>
            <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('pengiriman.edit', $pengiriman->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection