<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("css/home1.css") }}">
    <title>SPK Bantuan Sosial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="header-logo">Panutan.com</div>
        <!-- Navigation -->
        <nav class="header-nav">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('data-users.index') }}">Import Data</a>
            <a href="{{ route('data-users.analisis') }}">Analisis SAW</a>
            <a href="{{ route('tentang-kami') }}">Tentang Kami</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Sistem Pendukung Keputusan Penerima Bantuan Sosial</h1>
            <p class="hero-description">Bantu memilih penerima bantuan sosial secara tepat dan adil dengan analisis kriteria dan penilaian yang akurat.</p>
        </div>
    </section>

    <!-- Main Features Section -->
    <section class="features-section">
        <h2>Fitur Utama</h2>
        <div class="feature">
            <i class="fas fa-users feature-icon"></i>
            <h3>Manajemen Masyarakat</h3>
            <p>Kelola data masyarakat yang memenuhi syarat untuk menerima bantuan sosial.</p>
        </div>
        <div class="feature">
            <i class="fas fa-clipboard-list feature-icon"></i>
            <h3>Kriteria Penilaian</h3>
            <p>Tentukan kriteria penilaian seperti pendapatan, jumlah tanggungan, dan kondisi rumah tangga.</p>
        </div>
        <div class="feature">
            <i class="fas fa-balance-scale feature-icon"></i>
            <h3>Penilaian dan Hasil</h3>
            <p>Analisis dan hasil peringkat untuk memastikan distribusi bantuan sosial yang tepat sasaran.</p>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 SPK Bantuan Sosial. Semua Hak Dilindungi.</p>
        <p><a href="#">Kebijakan Privasi</a> | <a href="#">Syarat & Ketentuan</a> | <a href="#">Hubungi Kami</a></p>
    </footer>

</body>
</html>