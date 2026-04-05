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
                                    <h4 class="card-title mb-0">Tambah Distributor</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('distributor.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Distributor</label>
                                                    <input type="text" class="form-control @error('nama_distributor') is-invalid @enderror" 
                                                           name="nama_distributor" value="{{ old('nama_distributor') }}" required>
                                                    @error('nama_distributor')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Telepon</label>
                                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                                                           name="telepon" value="{{ old('telepon') }}" required>
                                                    @error('telepon')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Alamat</label>
                                                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                                              name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                                    @error('alamat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('distributor.index') }}" class="btn btn-secondary me-2">Batal</a>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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
