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
                                <h4 class="mb-0">Tambah Jenis Pengiriman</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('jenis-pengiriman.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Jenis Kirim</label>
                                        <select name="jenis_kirim" class="form-control" required>
                                            <option value="">Pilih Jenis Pengiriman</option>
                                            @foreach(App\Models\JenisPengiriman::jenisKirimList() as $key => $value)
                                                <option value="{{ $key }}" {{ old('jenis_kirim') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Ekspedisi</label>
                                        <input type="text" name="nama_ekspedisi" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Ongkos Kirim</label>
                                        <input type="number" name="ongkos_kirim" class="form-control" min="0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Logo Ekspedisi</label>
                                        <input type="file" name="logo_ekspedisi" class="form-control" accept="image/*">
                                    </div>
                                    <button class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('jenis-pengiriman.index') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
