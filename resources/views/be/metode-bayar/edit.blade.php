{{-- filepath: c:\xampp\htdocs\apotek-lsp\resources\views\be\metode-bayar\edit.blade.php --}}
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
                                <h4 class="card-title mb-0">Edit Metode Pembayaran</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('metode-bayar.update', $metode->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label">Metode Pembayaran</label>
                                        <input type="text" class="form-control" name="metode_pembayaran" value="{{ $metode->metode_pembayaran }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tempat Bayar</label>
                                        <input type="text" class="form-control" name="tempat_bayar" value="{{ $metode->tempat_bayar }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">No. Rekening</label>
                                        <input type="text" class="form-control" name="no_rekening" value="{{ $metode->no_rekening }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Logo (jpg/png, max 1MB)</label>
                                        @if($metode->url_logo)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/'.$metode->url_logo) }}" alt="Logo" style="height:36px;max-width:80px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" name="url_logo" accept="image/*">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah logo.</small>
                                    </div>
                                    <div class="text-end">
                                        <a href="{{ route('metode-bayar.index') }}" class="btn btn-secondary me-2">Batal</a>
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