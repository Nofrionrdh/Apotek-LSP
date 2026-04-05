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
                                <h4 class="card-title mb-0">Data Pelanggan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No. Telp</th>
                                                <th>Alamat 1</th>
                                                <th>Kota 1</th>
                                                <th>Provinsi 1</th>
                                                <th>Kodepos 1</th>
                                                <th>Foto</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pelanggans as $p)
                                            <tr>
                                                <td>{{ ($pelanggans->currentPage() - 1) * $pelanggans->perPage() + $loop->iteration }}</td>
                                                <td>{{ $p->nama_pelanggan }}</td>
                                                <td>{{ $p->email }}</td>
                                                <td>{{ $p->no_telp }}</td>
                                                <td>{{ $p->alamat1 }}</td>
                                                <td>{{ $p->kota1 }}</td>
                                                <td>{{ $p->propinsi1 }}</td>
                                                <td>{{ $p->kodepos1 }}</td>
                                                <td>
                                                    @if($p->foto)
                                                        <img src="{{ asset('storage/'.$p->foto) }}" alt="Foto" width="50" height="50" style="object-fit:cover;">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('data-pelanggan.destroy', $p->id) }}" method="POST" class="d-inline form-delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @if($pelanggans->isEmpty())
                                            <tr>
                                                <td colspan="10" class="text-center text-muted">Tidak ada data pelanggan.</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                @if ($pelanggans->hasPages())
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                        <nav>
                                            <ul class="pagination pagination-sm mb-0">
                                                @if ($pelanggans->onFirstPage())
                                                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link" href="{{ $pelanggans->previousPageUrl() }}">&laquo;</a></li>
                                                @endif
                                                @foreach ($pelanggans->getUrlRange(1, $pelanggans->lastPage()) as $page => $url)
                                                    @if ($page == $pelanggans->currentPage())
                                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach
                                                @if ($pelanggans->hasMorePages())
                                                    <li class="page-item"><a class="page-link" href="{{ $pelanggans->nextPageUrl() }}">&raquo;</a></li>
                                                @else
                                                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                                @endif
                                            </ul>
                                        </nav>
                                        <div class="text-muted small ms-1 mb-2 mb-md-0">
                                            Menampilkan {{ $pelanggans->firstItem() }} - {{ $pelanggans->lastItem() }} dari {{ $pelanggans->total() }} data
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
