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
                    <div class="col-md-8 mx-auto">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5 class="mb-0">Edit User</h5>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-3">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('manage-user.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                        <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required>
                                            <option value="">Pilih Jabatan</option>
                                            <option value="admin" {{ old('jabatan', $user->jabatan) == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="karyawan" {{ old('jabatan', $user->jabatan) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                            <option value="apoteker" {{ old('jabatan', $user->jabatan) == 'apoteker' ? 'selected' : '' }}>Apoteker</option>
                                            <option value="pemilik" {{ old('jabatan', $user->jabatan) == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                                            <option value="kasir" {{ old('jabatan', $user->jabatan) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                            <option value="kurir" {{ old('jabatan', $user->jabatan) == 'kurir' ? 'selected' : '' }}>Kurir</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="password" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" 
                                               placeholder="Kosongkan jika tidak ingin mengubah password">
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('manage-user.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left me-2"></i>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                                        </button>
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
