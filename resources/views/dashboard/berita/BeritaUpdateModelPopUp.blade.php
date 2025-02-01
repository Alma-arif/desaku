<!-- Modal untuk Update Pengguna -->
@foreach ($data as $user)
    <div class="modal fade" id="updateUserModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="updateUserModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModalLabel{{ $user->id }}">Update Pengguna</h5>
                    <button type="button" class="btn btn-sm btn-close" data-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('UserDashboard.update', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control d" id="email" name="email"
                                value="{{ $user->email }}" required disabled>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>User</option>
                                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-control" required>
                                @foreach ($jabatan as $data_jabatan)
                                    <option value="{{ $data_jabatan->id }}"
                                        {{ $user->jabatan_id == $data_jabatan->id ? 'selected' : '' }}>
                                        {{ $data_jabatan->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="5" placeholder="Masukkan Alamat..." required>{{ $user->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">No. Telephon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon"
                                value="{{ $user->telepon }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
