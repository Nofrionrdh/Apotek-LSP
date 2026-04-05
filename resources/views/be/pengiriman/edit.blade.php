{{-- filepath: c:\xampp\htdocs\apotek-lsp\resources\views\be\pengiriman\edit.blade.php --}}
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
                            <div class="card-header bg-info text-white">
                                <h4 class="mb-0">Edit Pengiriman</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('pengiriman.update', $pengiriman->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="mb-3">
                                        <label>Penjualan</label>
                                        <select name="id_penjualan" class="form-control" required>
                                            @foreach($penjualans as $p)
                                                <option value="{{ $p->id }}" {{ $pengiriman->id_penjualan == $p->id ? 'selected' : '' }}>{{ $p->no_transaksi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>No Invoice</label>
                                        <input type="text" name="no_invoice" class="form-control" value="{{ $pengiriman->no_invoice }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tanggal Kirim</label>
                                        <input type="datetime-local" name="tgl_kirim" class="form-control" value="{{ \Carbon\Carbon::parse($pengiriman->tgl_kirim)->format('Y-m-d\TH:i') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tanggal Tiba</label>
                                        <input type="datetime-local" name="tgl_tiba" class="form-control" value="{{ \Carbon\Carbon::parse($pengiriman->tgl_tiba)->format('Y-m-d\TH:i') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Status Kirim</label>
                                        <select name="status_kirim" class="form-control" required>
                                            <option value="Sedang Dikirim" {{ $pengiriman->status_kirim == 'Sedang Dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                                            <option value="Tiba Ditujuan" {{ $pengiriman->status_kirim == 'Tiba Ditujuan' ? 'selected' : '' }}>Tiba Ditujuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Kurir</label>
                                        <input type="text" name="nama_kurir" class="form-control" maxlength="30" value="{{ $pengiriman->nama_kurir }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Telpon Kurir</label>
                                        <input type="text" name="telpon_kurir" class="form-control" maxlength="15" value="{{ $pengiriman->telpon_kurir }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Bukti Foto</label>
                                        <input type="file" name="bukti_foto" class="form-control" accept="image/*">
                                        @if($pengiriman->bukti_foto)
                                            <img src="{{ asset('storage/'.$pengiriman->bukti_foto) }}" alt="Bukti" width="80" class="mt-2">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control">{{ $pengiriman->keterangan }}</textarea>
                                    </div>
                                    <button class="btn btn-info">Update</button>
                                    <a href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
@endsection