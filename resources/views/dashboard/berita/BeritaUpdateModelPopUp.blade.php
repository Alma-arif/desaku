<!-- Modal untuk Update Pengguna -->
@foreach ($data as $berita)
    <div class="modal fade" id="updateModal{{ $berita->id }}" tabindex="-1"
        aria-labelledby="updateModalLabel{{ $berita->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel{{ $berita->id }}">Update Pengguna</h5>
                    <button type="button" class="btn btn-sm btn-close" data-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('BeritaDashboard.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Judul Berita --}}
                        <div class="form-group">
                            <label for="judul">Judul Berita</label>
                            <input type="text" name="judul" class="form-control" value="{{ $berita->judul }}" required>
                        </div>

                        {{-- Kategori Berita --}}
                        <div class="form-group">
                            <label for="kategori">Kategori Berita</label>
                            <select name="id_kategori" class="form-control" required>
                                @foreach ($kategori as $kategory)
                                    <option value="{{ $kategory->id }}" {{ $berita->id_kategory == $kategory->id ? 'selected' : '' }}>
                                        {{ $kategory->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status Berita --}}
                        <div class="form-group">
                            <label for="status">Status Berita</label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ $berita->status == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $berita->status == 0 ? 'selected' : '' }}>Non Aktif</option>
                            </select>
                        </div>

                        {{-- Isi Berita --}}
                        <div class="form-group">
                            <label for="isi">Isi Berita</label>
                            <textarea name="isi" class="form-control" rows="5" required>{{ $berita->isi }}</textarea>
                        </div>

                        {{-- Upload Gambar --}}
                        <div class="form-group">
                            <label for="image">Gambar Berita</label>
                            <input type="file" name="image" class="form-control" onchange="previewImage(event)">

                            {{-- Gambar Lama --}}
                            @if ($berita->image)
                                <p>Gambar Saat Ini:</p>
                                <img src="{{ asset('storage/' . $berita->image) }}" id="current-image" style="max-width: 300px; margin-bottom: 10px;">
                            @endif

                            {{-- Preview Gambar Baru --}}
                            <img id="preview" src="#" alt="Preview Gambar Baru" style="max-width: 300px; display: none;">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Berita</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endforeach



@section('js')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';

                    const currentImage = document.getElementById('current-image');
                    if (currentImage) {
                        currentImage.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@stop
