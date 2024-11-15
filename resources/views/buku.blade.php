<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Manajemen Buku</h2>
        
        <!-- Tombol Tambah Buku -->
        <div class="d-flex justify-content-start mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bukuModal">Tambah Buku</button>
        </div>
        
        <div class="modal fade" id="bukuModal" tabindex="-1" aria-labelledby="bukuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Tambah Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="bukuForm" action="{{ route('buku.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="bukuId" name="id">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" id="judul" name="judul" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" id="penulis" name="penulis" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" id="tahun" name="tahun" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <input type="text" id="genre" name="genre" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Daftar Buku, di tengah halaman -->
        <div class="d-flex justify-content-center">
            <table class="table table-bordered table-striped" style="width: 80%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Genre</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buku as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->penulis }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->genre }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBukuModal{{ $item->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editBukuModal{{ $item->id }}" tabindex="-1" aria-labelledby="editBukuModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editBukuModalLabel">Edit Buku</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('buku.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="judul" class="form-label">Judul</label>
                                                        <input type="text" id="judul" name="judul" class="form-control" value="{{ $item->judul }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="penulis" class="form-label">Penulis</label>
                                                        <input type="text" id="penulis" name="penulis" class="form-control" value="{{ $item->penulis }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tahun" class="form-label">Tahun</label>
                                                        <input type="number" id="tahun" name="tahun" class="form-control" value="{{ $item->tahun }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="genre" class="form-label">Genre</label>
                                                        <input type="text" id="genre" name="genre" class="form-control" value="{{ $item->genre }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('buku.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            
        </div>
        <div class="position-fixed bottom-0 end-0 mb-4 me-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
        
    </body>
    </html>
