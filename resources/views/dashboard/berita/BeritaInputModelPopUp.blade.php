<!-- Modal untuk Menambah Pengguna Baru -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah Berita Baru</h5>
                <button type="button" class="btn btn-sm btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('BeritaDashboard.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ old('judul') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi_berita" class="form-label">Isi Berita</label>
                        <textarea name="isi" id="isi_berita" class="form-control" rows="5" placeholder="Masukkan Isi Berita..." required>{{ old('isi') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="id_kategory" id="kategori" class="form-control" required>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="aktif" selected>Aktif</option>
                            <option value="no_aktif">No Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
