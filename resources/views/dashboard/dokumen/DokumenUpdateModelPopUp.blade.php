<!-- Modal untuk Update Pengguna -->
@foreach ($data as $jabatan)
    <div class="modal fade" id="updateModal{{ $jabatan->id }}" tabindex="-1"
        aria-labelledby="updateModalLabel{{ $jabatan->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel{{ $jabatan->id }}">Update Data Jabatan</h5>
                    <button type="button" class="btn btn-sm btn-close" data-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('JabatanDashboard.update', ['id' => $jabatan->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_jabatan" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan"
                                value="{{ $jabatan->nama_jabatan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tingkat_jabatan" class="form-label">Tingkat Jabatan</label>
                            <input type="tingkat_jabatan" class="form-control d" id="tingkat_jabatan" name="tingkat_jabatan"
                                value="{{ $jabatan->tingkat_jabatan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan_jabatan" class="form-label">Keterangan</label>
                            <textarea name="keterangan_jabatan" id="keterangan_jabatan" class="form-control" rows="5" placeholder="Masukkan Keterangan tambahan...">{{ $jabatan->keterangan_jabatan }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="aktif" {{ $jabatan->status == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="no_aktif" {{ $jabatan->status == 0 ? 'selected' : '' }}>No Aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
