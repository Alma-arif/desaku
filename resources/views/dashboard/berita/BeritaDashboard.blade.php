@extends('layouts.layout')

{{-- Customize layout sections --}}

@section('subtitle', 'Berita')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Berita')

{{-- Content body: main page content --}}

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Table</h3>

    </div>
    <div class="card-header">
        <a href="javascript:void(0);" class=" float-left btn btn-sm btn-info " data-bs-toggle="modal" data-bs-target="#addUserModal">
            Tambah Berita Baru
        </a>
        <div class="card-tools">

            <!-- Form Pencarian -->
            <form action="{{ url()->current() }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
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
                    <th>Image</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $berita)
                <tr>

                    <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                    <td><img src="{{ $berita->image }}" alt="Image" class="img-thumbnail" width="50"></td>
                    {{-- <td>{{ $berita->judul }}</td> --}}
                    <td> <a href="javascript:void(0);" class="link-toggle" onclick="toggleRow1({{ $berita->id }})">
                        {{ Str::limit($berita->judul, 2, '...') }}
                    </a></td>
                    <td> <a href="javascript:void(1);" class="link-toggle" onclick="toggleRow2({{ $berita->id }})">
                        {{ Str::limit($berita->isi, 15, '...') }}
                    </a></td>
                    <td>{{ $berita->user->name }}</td>
                    <td>{{ $berita->berita_kategori->judul }}</td>
                    <td> @if ($berita->status == 1)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Non Aktif</span>
                    @endif</td>
                    <td>
                        <a href="javascript:void(0);" class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#updateUserModal{{ $berita->id }}">
                            Edit
                        </a>

                        <div class="btn-group">
                            <form action="{{ route('BeritaDashboard.delete', ['id' => $berita->id]) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('delete')
                            <button class="btn btn-danger delete-btn">Delete</button>
                        </form>

                        </div>

                    </td>
                </tr>
                <tr id="row-detail-judul-{{ $berita->id }}" style="display: none;">
                    <td colspan="4">
                        <strong>Judul:</strong> {{ $berita->judul }}
                    </td>
                </tr>
                <tr id="row-detail-isi-{{ $berita->id }}" style="display: none;">
                    <td colspan="4">
                        <strong>Isi Berita:</strong> {{ $berita->isi }}
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
 @include('dashboard.berita.BeritaInputModelPopUp')

 <!-- Modal untuk Menambah dan Update Pengguna -->
 {{-- @include('dashboard.berita.BeritaUpdateModelPopUp') --}}


@stop

@push('css')
    <!-- CSS untuk Link -->
<style>
    .link-toggle {
        color: inherit; /* Mengambil warna teks dari elemen induk */
        text-decoration: none; /* Menghilangkan garis bawah */
        cursor: pointer; /* Membuat cursor menjadi pointer saat hover */
    }
    .link-toggle:hover {
        color: #007bff; /* Memberikan warna saat hover (ubah sesuai preferensi) */
    }
</style>
@endpush

{{-- Push extra scripts --}}

@push('js')


<script>

    function toggleRow1(id) {
        const row = document.getElementById('row-detail-judul-' + id);
        row.style.display = row.style.display === 'none' ? '' : 'none';
    }
    function toggleRow2(id) {
        const row = document.getElementById('row-detail-isi-' + id);
        row.style.display = row.style.display === 'none' ? '' : 'none';
    }
</script>
<script>
    // Pastikan modal Bootstrap diinisialisasi dengan benar
    // const addUserModal = new bootstrap.Modal(document.getElementById('addUserModal'));
    const updateUserModals = document.querySelectorAll('[id^="updateUserModal"]');

    // Tampilkan modal jika tombol ditekan
    // addUserModal.show();

    // Untuk modal update
    updateUserModals.forEach((modal) => {
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
        const addUserModal = new bootstrap.Modal(document.getElementById('addUserModal'));
        const addUserButton = document.querySelector('[data-bs-toggle="modal"][data-bs-target="#addUserModal"]');

        // Pastikan modal muncul ketika tombol ditekan
        addUserButton.addEventListener('click', function() {
            addUserModal.show();
        });
    });
</script>

@endpush
