<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="header-logo">Panutan.com</div>
        <nav class="header-nav">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('data-users.index') }}">Import Data</a>
            <a href="{{ route('data-users.analisis') }}">Analisis SAW</a>
            <a href="{{ route('tentang-kami') }}">Tentang Kami</a>
        </nav>
    </header>

    <!-- Content Section -->
    <main class="content-section">
        <h1>Manajemen Masyarakat</h1>
        <p>Kelola data masyarakat untuk mendukung analisis dan distribusi bantuan sosial.</p>
        
        <!-- Content Sections -->
        <section id="imporData">
            <h2>Impor Data</h2>
            <p>Unggah file Excel untuk menambahkan data masyarakat secara massal:</p>
            <form action="{{ route('data-users.import') }}" method="POST" enctype="multipart/form-data" class="upload-form">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File Excel</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
        </section>

        <section id="daftarMasyarakat">
            <h2>Daftar Masyarakat</h2>
            <p>Berikut adalah daftar masyarakat yang sudah terdaftar:</p>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pendapatan</th>
                        <th>Kepemilikan Aset</th>
                        <th>Jumlah Tanggungan</th>
                        <th>Terdaftar di DKTS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataUsers as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->pendapatan }}</td>
                            <td>{{ $user->kepemilikan_aset }}</td>
                            <td>{{ $user->jumlah_tanggungan }}</td>
                            <td>{{ $user->terdaftar_dkts}}</td>
                            <td class="actions-cell">
                                <!-- Form Hapus -->
                                <form action="{{ route('data-users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn-delet"><i class="bi bi-trash"></i> Hapus</button>
                                </form>
                                <button onclick="openEditModal({{ $user->id }}, '{{ $user->nama }}', '{{ $user->pendapatan }}', '{{ $user->kepemilikan_aset }}', '{{ $user->jumlah_tanggungan }}', '{{ $user->terdaftar_dkts }}')" class="btn-edit"><i class="bi bi-pencil-square"></i> Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Paginasi -->
            {{ $dataUsers->links() }} <!-- Ini adalah link navigasi pagination -->
    
        </section>


        <section id="hapusData">
            <h2>Hapus Data</h2>
            <p>Hapus data masyarakat dari daftar. Pastikan Anda berhati-hati sebelum menghapus data.</p>
            <form action="{{ route('data-users.destroyAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus semua data?')" class="btn-delet1"><i class="bi bi-trash"></i> Hapus Semua</button>
            </form>    
        </section>

        <section class="wrap-btn-saw">
            <a href="{{ route('data-users.analisis') }}" class="a-saw">Analisis SAW</a>
        </section>
    </main>

   

    <!-- Modal untuk Edit Data -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Data Masyarakat</h2>
            <form action="{{ route('data-users.update', '') }}" method="POST" id="editForm">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" id="userId">

                <div class="mb-3">
                    <label for="editNama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="editNama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="editPendapatan" class="form-label">Pendapatan</label>
                    <input type="text" name="pendapatan" id="editPendapatan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="editKepemilikanAset" class="form-label">Kepemilikan Aset</label>
                    <input type="text" name="kepemilikan_aset" id="editKepemilikanAset" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="editJumlahTanggungan" class="form-label">Jumlah Tanggungan</label>
                    <input type="number" name="jumlah_tanggungan" id="editJumlahTanggungan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="editTerdaftarDkts" class="form-label">Terdaftar di DKTS</label>
                    <select name="terdaftar_dkts" id="editTerdaftarDkts" class="form-control" required>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui Data</button>
            </form>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 SPK Bantuan Sosial. Semua Hak Dilindungi.</p>
        <p><a href="#">Kebijakan Privasi</a> | <a href="#">Syarat & Ketentuan</a> | <a href="#">Hubungi Kami</a></p>
    </footer>

    <script>
        // Menampilkan modal edit
        function openEditModal(id, nama, pendapatan, kepemilikan_aset, jumlah_tanggungan, terdaftar_dkts) {
            document.getElementById('userId').value = id;
            document.getElementById('editNama').value = nama;
            document.getElementById('editPendapatan').value = pendapatan;
            document.getElementById('editKepemilikanAset').value = kepemilikan_aset;
            document.getElementById('editJumlahTanggungan').value = jumlah_tanggungan;
            document.getElementById('editTerdaftarDkts').value = terdaftar_dkts;
            document.getElementById('editModal').style.display = "block";
            document.getElementById('editForm').action = '/data-users/' + id; // Set action URL form update
        }

        // Menutup modal edit
        function closeEditModal() {
            document.getElementById('editModal').style.display = "none";
        }

        // Menutup modal ketika klik di luar modal
        window.onclick = function(event) {
            if (event.target == document.getElementById('editModal')) {
                closeEditModal();
            }
        }
    </script>
</body>
</html>