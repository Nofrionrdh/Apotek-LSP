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
                                    <h4 class="mb-0">Tambah Jenis Obat</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('jenis-obat.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nama Jenis</label>
                                            <input type="text"
                                                class="form-control @error('nama_jenis') is-invalid @enderror"
                                                name="nama_jenis" value="{{ old('nama_jenis') }}" required>
                                            @error('nama_jenis')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gambar</label>
                                            <div class="custom-file-container">
                                                <div class="input-group">
                                                    <label class="input-group-text bg-primary text-white" for="fileInput">
                                                        Pilih Gambar
                                                    </label>
                                                    <input type="file"
                                                        class="form-control @error('gambar') is-invalid @enderror"
                                                        name="gambar" id="fileInput" accept="image/*"
                                                        onchange="previewImage(this)" style="display: none;">
                                                    <input type="text" class="form-control" id="fileLabel"
                                                        placeholder="Tidak ada file dipilih" readonly>
                                                </div>
                                                @error('gambar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="mt-2 text-center">
                                                    <img id="preview" src="#" alt="Preview" class="img-thumbnail"
                                                        style="max-width: 200px; display: none;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('jenis-obat.index') }}"
                                                class="btn btn-secondary me-2">Batal</a>
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
    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const fileLabel = document.getElementById('fileLabel');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
                fileLabel.value = input.files[0].name;
            } else {
                preview.src = '#';
                preview.style.display = 'none';
                fileLabel.value = 'Tidak ada file dipilih';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.input-group-text').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                document.getElementById('fileInput').click();
            });
        });
    </script>
@endsection
