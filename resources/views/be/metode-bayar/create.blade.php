{{-- filepath: c:\xampp\htdocs\apotek-lsp\resources\views\be\metode-bayar\create.blade.php --}}
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
                                <h4 class="card-title mb-0">Tambah Metode Pembayaran</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('metode-bayar.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Metode Pembayaran</label>
                                        <input type="text" class="form-control" name="metode_pembayaran" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tempat Bayar</label>
                                        <input type="text" class="form-control" name="tempat_bayar" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">No. Rekening</label>
                                        <input type="text" class="form-control" name="no_rekening" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Logo (jpg/png, max 1MB)</label>
                                        <input type="file" class="form-control" name="url_logo" accept="image/*">
                                    </div>
                                    <div class="text-end">
                                        <a href="{{ route('metode-bayar.index') }}" class="btn btn-secondary me-2">Batal</a>
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