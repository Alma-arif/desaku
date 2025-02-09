<!-- Modal untuk Menambah Pengguna Baru -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Jabatan Baru</h5>
                <button type="button" class="btn btn-sm btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('JabatanDashboard.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ old('judul') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="file">File Dokumen</label>
                        <input type="file" name="file" class="form-control" onchange="previewImage(event)" required>
                        <br>
                        <img id="preview" src="#" alt="Preview File" style="max-width: 300px; display: none;" />
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
