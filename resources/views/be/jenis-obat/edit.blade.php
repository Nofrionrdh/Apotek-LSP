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
                                    <h4 class="card-title mb-0">Edit Jenis Obat</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('jenis-obat.update', $jenis_obat->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Jenis</label>
                                                    <input type="text"
                                                        class="form-control @error('nama_jenis') is-invalid @enderror"
                                                        name="nama_jenis"
                                                        value="{{ old('nama_jenis', $jenis_obat->nama_jenis) }}" required>
                                                    @error('nama_jenis')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('jenis-obat.index') }}"
                                                class="btn btn-secondary me-2">Batal</a>
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
