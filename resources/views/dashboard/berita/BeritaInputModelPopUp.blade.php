<!-- Modal untuk Menambah Pengguna Baru -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah Berita Baru</h5>
                <button type="button" class="btn btn-sm btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('BeritaDashboard.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="judul">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kategori_berita">Kategori Berita</label>
                        <select name="kategori_berita" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->judul }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status Berita</label>
                        <select name="status" class="form-control" required>
                            <option value="1">Aktif</option>
                            <option value="0">Non Aktif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="isi">Isi Berita</label>
                        <textarea name="isi" class="form-control" rows="5" required>{{ old('isi') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Berita</label>
                        <input type="file" name="image" class="form-control" onchange="previewImage(event)" required>
                        <br>
                        <img id="preview" src="#" alt="Preview Gambar" style="max-width: 300px; display: none;" />
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Berita</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@stop
