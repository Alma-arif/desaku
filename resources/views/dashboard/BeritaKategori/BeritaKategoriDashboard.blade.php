@extends('layouts.layout')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

{{-- Content body: main page content --}}

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Kategori</h3>

    </div>
    <div class="card-header">
        <a href="javascript:void(0);" class=" float-left btn btn-sm btn-info " data-bs-toggle="modal" data-bs-target="#addModal">
            Tambah Kategori Baru
        </a>
        <div class="card-tools">

            <!-- Form Pencarian -->
            <form action="{{ url()->current() }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
                {{-- @csrf --}}
                <input type="text" name="search" class="form-control float-right" placeholder="Search..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $kategori)
                <tr>

                    <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                    <td>{{ $kategori->judul }}</td>
                    <td> <a href="javascript:void(0);" class="link-toggle" onclick="toggleRow({{ $kategori->id }})">
                        {{ Str::limit($kategori->keterangan, 20, '...') }}
                    </a>
                    <td>
                        <a href="javascript:void(0);" class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $kategori->id }}">
                            Edit
                        </a>
                        <div class="btn-group">
                            <form action="{{ route('BeritaKategoriDashboard.delete', ['id' => $kategori->id]) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                            <button class="btn btn-danger delete-btn">Delete</button>
                        </form>
                        </div>
                    </td>
                </tr>
                <tr id="row-detail-{{ $kategori->id }}" style="display: none;">
                    <td colspan="4">
                        <strong>Keterangan Lengkap:</strong> {{ $kategori->keterangan }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No data available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        <div class="float-right">
            {{ $data->links() }}

        </div>
    </div>
</div>

 <!-- Tabel Pengguna -->
 @include('dashboard.BeritaKategori.BeritaKategoriInputModelPopUp')

 <!-- Modal untuk Menambah dan Update Pengguna -->
 @include('dashboard.BeritaKategori.BeritaKategoriUpdateModelPopUp')


@stop

@push('css')
    <!-- CSS untuk Link -->
<style>
    .link-toggle {
        color: inherit;
        text-decoration: none;
        cursor: pointer;
    }
    .link-toggle:hover {
        color: #007bff;
    }
</style>
@endpush

{{-- Push extra scripts --}}

@push('js')
<script>


    function toggleRow(id) {
        const row = document.getElementById('row-detail-' + id);
        row.style.display = row.style.display === 'none' ? '' : 'none';
    }
</script>
<script>
    // Pastikan modal Bootstrap diinisialisasi dengan benar
    const updateModals = document.querySelectorAll('[id^="updateModal"]');


    // Untuk modal update
    updateModals.forEach((modal) => {
        const modalInstance = new bootstrap.Modal(modal);
        const editButtons = document.querySelectorAll(`[data-bs-target="#${modal.id}"]`);

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                modalInstance.show();
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addModal = new bootstrap.Modal(document.getElementById('addModal'));
        const addUserButton = document.querySelector('[data-bs-toggle="modal"][data-bs-target="#addModal"]');

        // Pastikan modal muncul ketika tombol ditekan
        addUserButton.addEventListener('click', function() {
            addModal.show();
        });
    });
</script>

@endpush
