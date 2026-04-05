{{-- filepath: c:\xampp\htdocs\apotek-lsp\resources\views\be\pengiriman\create.blade.php --}}
@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('main-content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="row w-100">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Tambah Pengiriman</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('pengiriman.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Penjualan</label>
                                        <select name="id_penjualan" class="form-control" required>
                                            <option value="">Pilih Penjualan</option>
                                            @foreach($penjualans as $p)
                                                <option value="{{ $p->id }}">
                                                    {{ $p->no_pemesanan }} - 
                                                    {{ $p->pelanggan ? $p->pelanggan->nama_pelanggan : '-' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>No Invoice</label>
                                        <input type="text" name="no_invoice" class="form-control" 
                                            value="MDC-{{ date('ymd') }}-{{ rand(100,999) }}" readonly required>
                                        <small class="text-muted">Nomor invoice digenerate otomatis</small>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nomor Resi</label>
                                        <input type="text" class="form-control" value="Auto Generate" readonly disabled>
                                        <small class="text-muted">Nomor resi akan di-generate otomatis saat pengiriman disimpan</small>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tanggal Kirim</label>
                                        <input type="datetime-local" name="tgl_kirim" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tanggal Tiba</label>
                                        <input type="datetime-local" name="tgl_tiba" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Status Kirim</label>
                                        <select name="status_kirim" class="form-control" required>
                                            <option value="Sedang Dikirim">Sedang Dikirim</option>
                                            <option value="Tiba Ditujuan">Tiba Ditujuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Kurir</label>
                                        <select name="nama_kurir" class="form-control" required>
                                            <option value="">Pilih Kurir</option>
                                            @foreach($kurirs as $kurir)
                                                <option value="{{ $kurir->name }}">{{ $kurir->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Telpon Kurir</label>
                                        <input type="text" name="telpon_kurir" class="form-control" maxlength="15" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Bukti Foto</label>
                                        <input type="file" name="bukti_foto" class="form-control" accept="image/*" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control"></textarea>
                                    </div>
                                    <button class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
@endsection