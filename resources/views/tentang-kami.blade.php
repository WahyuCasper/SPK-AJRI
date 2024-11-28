<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link rel="stylesheet" href="{{ asset("css/tentang-kami.css") }}">
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
            <a href="{{ route('data-users.analisis') }}">Analisis SAW</a>a>
            <a href="{{ route('tentang-kami') }}">Tentang Kami</a>
        </nav>
    </header>

    <!-- Content Section -->
    <main class="content-section">
        <h1>Tentang Kami</h1>
        <p>Kami adalah tim yang berdedikasi untuk mengembangkan Sistem Pendukung Keputusan (SPK) untuk distribusi bantuan sosial yang adil dan tepat sasaran.</p>
        
        <!-- Team Section -->
        <section class="team-section">
            <h2>Anggota Tim</h2>
            <div class="wrap-tim">
                <div class="team-container">
                    <!-- Member 1 -->
                    <div class="team-member">
                        <i class="fas fa-male team-icon"></i>
                        <h3>Muhammad Raihan Azri</h3>
                        <p>413422037</p>
                    </div>
                    <!-- Member 2 -->
                    <div class="team-member">
                        <i class="fas fa-female team-icon"></i>
                        <h3>Adisti Dayo</h3>
                        <p>413422037</p>
                    </div>
                    <!-- Member 3 -->
                    <div class="team-member">
                        <i class="fas fa-female team-icon"></i>
                        <h3>Siskawati Zees</h3>
                        <p>413422037</p>
                    </div>
                    <!-- Member 4 -->
                    <div class="team-member">
                        <i class="fas fa-female team-icon"></i>
                        <h3>Indri Lamusu</h3>
                        <p>413422037</p>
                    </div>
                    <!-- Member 5 -->
                    <div class="team-member">
                        <i class="fas fa-female team-icon"></i>
                        <h3>Alivra Napu</h3>
                        <p>413422037</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 SPK Bantuan Sosial. Semua Hak Dilindungi.</p>
        <p><a href="#">Kebijakan Privasi</a> | <a href="#">Syarat & Ketentuan</a> | <a href="#">Hubungi Kami</a></p>
    </footer>
</body>
</html>