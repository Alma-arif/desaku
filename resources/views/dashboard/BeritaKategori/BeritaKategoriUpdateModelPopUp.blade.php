<!-- Modal untuk Update Pengguna -->
@foreach ($data as $kategori)
    <div class="modal fade" id="updateModal{{ $kategori->id }}" tabindex="-1"
        aria-labelledby="updateModalLabel{{ $kategori->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel{{ $kategori->id }}">Update Data kategori</h5>
                    <button type="button" class="btn btn-sm btn-close" data-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('BeritaKategoriDashboard.update', ['id' => $kategori->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $kategori->judul}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="Masukkan Keterangan tambahan...">{{ $kategori->keterangan }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
