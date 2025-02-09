<!-- Modal untuk Menambah Pengguna Baru -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Ketgori Baru</h5>
                <button type="button" class="btn btn-sm btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('BeritaKategoriDashboard.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">

                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ old('nama') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="Masukkan Keterangan tambahan...">{{ old('keterangan_jabatan') }}</textarea>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="aktif" selected>Aktif</option>
                            <option value="no_aktif">No Aktif</option>
                        </select>
                    </div> --}}
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
