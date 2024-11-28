<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="{{ asset('css/analisis.css') }}">
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

<main class="content-section">
    <!-- Form untuk mengupdate data -->
    <form action="{{ route('update-data-users') }}" method="POST">
        @csrf
        <button type="submit" class="btn-normalisasi">Normalisasi Data</button>
    </form>

    <!-- Tampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <section>
        <!-- Tabel Data Pengguna -->
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pendapatan</th>
                    <th>Kepemilikan Aset</th>
                    <th>Jumlah Tanggungan</th>
                    <th>Terdaftar di DKTS</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Paginasi -->
        {{ $dataUsers->links() }} <!-- Ini adalah link navigasi pagination -->
    </section>
    <section>
        <!-- Form untuk Analisis SAW -->
        <form action="{{ route('analisis-saw') }}" method="GET">
            <div class="wrap-btn-saw">
                <button type="submit" class="btm-analisis-saw">Analisis SAW</button>
            </div>
        </form>

        @if(isset($hasilSAW) && count($hasilSAW) > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pendapatan</th>
                        <th>Kepemilikan Aset</th>
                        <th>Jumlah Tanggungan</th>
                        <th>Terdaftar di DKTS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasilSAW as $hasil)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $hasil['nama'] }}</td>
                            <td>{{ $hasil['min_p'] }}</td>
                            <td>{{ $hasil['max_k'] }}</td>
                            <td>{{ $hasil['max_j'] }}</td>
                            <td>{{ $hasil['min_t'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pendapatan</th>
                        <th>Kepemilikan Aset</th>
                        <th>Jumlah Tanggungan</th>
                        <th>Terdaftar di DKTS</th>
                        <th>Skor SAW</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasilSAW as $hasil)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $hasil['nama'] }}</td>
                            <td>{{ $hasil['skorSAW_p'] }}</td>
                            <td>{{ $hasil['skorSAW_k'] }}</td>
                            <td>{{ $hasil['skorSAW_j'] }}</td>
                            <td>{{ $hasil['skorSAW_t'] }}</td>
                            <td>{{ number_format($hasil['skor'], 4) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada hasil SAW untuk ditampilkan.</p>
        @endif
        {{ $dataUsers->links() }}
    </section>
</main>

<footer>
    <p>&copy; 2024 SPK Bantuan Sosial. Semua Hak Dilindungi.</p>
    <p><a href="#">Kebijakan Privasi</a> | <a href="#">Syarat & Ketentuan</a> | <a href="#">Hubungi Kami</a></p>
</footer>
</body>
</html>
