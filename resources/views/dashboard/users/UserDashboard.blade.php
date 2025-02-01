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
            Tambah Pengguna Baru
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
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Telpon</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Alamat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $user)
                <tr>

                    <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                    <td><img src="" alt="Foto Profil" class="img-thumbnail" width="50"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telepon }}</td>
                    <td>{{ $user->jabatan->nama_jabatan }}</td>
                    <td>{{ $user->role }}</td>
                    <td> <a href="javascript:void(0);" class="link-toggle" onclick="toggleRow({{ $user->id }})">
                        {{ Str::limit($user->alamat, 15, '...') }}
                    </a></td>
                    <td>
                        <a href="javascript:void(0);" class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#updateUserModal{{ $user->id }}">
                            Edit
                        </a>
                        <!-- Tombol Delete -->
                        {{-- <a href="javascript:void(0);" class="btn btn-danger" data-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteData({{ $user->id }})">Delete</a> --}}
                        <div class="btn-group">
                            <form action="{{ route('UserDashboard.delete', ['id' => $user->id]) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('delete')
                            <button class="btn btn-danger delete-btn">Delete</button>
                        </form>

                        </div>
                        {{-- <button class="btn btn-sm btn-primary">Edit</button> --}}
                        {{-- <button class="btn btn-sm btn-danger">Delete</button> --}}
                    </td>
                </tr>
                <tr id="row-detail-{{ $user->id }}" style="display: none;">
                    <td colspan="4">
                        <strong>Alamat Lengkap:</strong> {{ $user->alamat }}
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
 @include('dashboard.users.UserInputModelPopUp')

 <!-- Modal untuk Menambah dan Update Pengguna -->
 @include('dashboard.users.UserUpdateModelPopUp')


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


    function toggleRow(id) {
        const row = document.getElementById('row-detail-' + id);
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
