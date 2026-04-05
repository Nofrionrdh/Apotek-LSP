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
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Edit Obat</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Obat</label>
                                                    <input type="text"
                                                        class="form-control @error('nama_obat') is-invalid @enderror"
                                                        name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}"
                                                        required>
                                                    @error('nama_obat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Obat</label>
                                                    <select name="jenis_obat_id"
                                                        class="form-control @error('jenis_obat_id') is-invalid @enderror"
                                                        required>
                                                        @foreach ($jenis_obat as $j)
                                                            <option value="{{ $j->id }}" {{ $obat->id_jenis == $j->id ? 'selected' : '' }}>{{ $j->jenis }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('jenis_obat_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Stok</label>
                                                    <input type="number"
                                                        class="form-control @error('stok') is-invalid @enderror"
                                                        name="stok" value="{{ old('stok', $obat->stok) }}" required>
                                                    @error('stok')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Harga</label>
                                                    <input type="number"
                                                        class="form-control @error('harga') is-invalid @enderror"
                                                        name="harga" value="{{ old('harga', $obat->harga) }}" required>
                                                    @error('harga')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('obat.index') }}" class="btn btn-secondary me-2">Batal</a>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
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
