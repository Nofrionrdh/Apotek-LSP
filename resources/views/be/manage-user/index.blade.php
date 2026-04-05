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
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">Daftar User</h4>
                                    <a href="{{ route('manage-user.create') }}" class="btn btn-primary">
                                        Tambah User
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-striped">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th width="5%">No</th>
                                                    <th width="20%">Nama</th>
                                                    <th width="25%">Email</th>
                                                    {{-- <th width="15%">No HP</th> --}}
                                                    <th width="15%">Jabatan</th>
                                                    <th width="20%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        {{-- <td>{{ $user->no_hp }}</td> --}}
                                                        <td>{{ $user->jabatan }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('manage-user.edit', $user->id) }}"
                                                                    class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>
                                                                <form action="{{ route('manage-user.destroy', $user->id) }}" method="POST" class="d-inline form-delete">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($users->hasPages())
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                            <nav>
                                                <ul class="pagination pagination-sm mb-0">
                                                    @if ($users->onFirstPage())
                                                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}">&laquo;</a></li>
                                                    @endif
                                                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                                        @if ($page == $users->currentPage())
                                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                        @endif
                                                    @endforeach
                                                    @if ($users->hasMorePages())
                                                        <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}">&raquo;</a></li>
                                                    @else
                                                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                                    @endif
                                                </ul>
                                            </nav>
                                            <div class="text-muted small ms-1 mb-2 mb-md-0">
                                                Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} data
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const form = btn.closest('form');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection

