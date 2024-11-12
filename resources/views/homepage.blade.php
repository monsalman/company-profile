<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Forte Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero-section {
            background: #dc3545;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0.1;
        }
        .service-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(0,0,0,0.05);
            height: 100%;
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(255, 51, 102, 0.1);
        }
        .client-logo {
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all 0.3s ease;
            max-height: 60px;
            object-fit: contain;
        }
        .client-logo:hover {
            filter: grayscale(0%);
            opacity: 1;
        }
        .section-title {
            position: relative;
            margin-bottom: 3rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: #ff3366;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <div class="d-flex align-items-center">
                <img src="{{ asset('storage/' . \App\Models\Setting::where('key', 'logo')->first()?->value ?? 'logo.png') }}" alt="Logo" height="40">
                @auth
                    <a href="#" class="ms-2 text-danger" data-bs-toggle="modal" data-bs-target="#logoModal">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                @endauth
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portofolio">Portofolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#informasi">Informasi</a></li>
                    @auth
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link border-0 bg-transparent text-danger">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="beranda" class="hero-section text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Digitalisasi Bisnis Anda</h1>
                    <p class="lead mb-4">Mengefisiensikan Bisnis Anda dengan menjadikannya terstruktur, termonitor dan tepat sasaran dengan teknologi terkini dan user friendly</p>
                    <div class="d-flex gap-3">
                        <a href="#kontak" class="btn btn-light btn-lg px-4">Mulai Sekarang</a>
                        <a href="#layanan" class="btn btn-outline-light btn-lg px-4">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="hero-image.png" alt="Carousel slider" class="img-fluid">
                </div>
            </div>
        </div>
    </header>

    <!-- Clients Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Klien Kami</h2>
            <div class="row align-items-center justify-content-center">
                <div class="col-4 col-md-2 mb-4">
                    <img src="client1.png" alt="Carousel SliderClient" class="client-logo w-100">
                </div>
                <!-- Tambahkan logo klien lainnya -->
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="layanan" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Layanan Kami</h2>
            
            <!-- Custom Development Description -->
            <div class="text-start mb-5">
                <h5 class="mb-4" style="color: #E31E2D; font-size: 3.5rem; font-weight: bold;">Service Custom Development</h5>
                <p style="color: #666; font-size: 1rem; line-height: 1.4; max-width: 1200px;">
                    Pengembangan perangkat lunak customisasi adalah proses merancang, membuat, menyebarkan, dan memelihara perangkat lunak yang bertujuan agar dapat digunakan dalam sekumpulan pengguna, fungsi, atau organisasi tertentu.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-globe fs-1 text-danger mb-3"></i>
                            <h4>Website Development</h4>
                            <p class="text-muted">Membangun Website Bisnis maupun Professional bagi Bisnis anda dengan teknologi terkini dan tampilan menarik</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-phone fs-1 text-primary mb-3"></i>
                            <h4>Mobile Development</h4>
                            <p class="text-muted">Membangung ataupun mengembangkan aplikasi mobile berbasis android maupun IOS yang dapat disesuaikan dengan kebutuhan bisnis</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-pc-display fs-1 text-primary mb-3"></i>
                            <h4>Software Development</h4>
                            <p class="text-muted">Membangun Software berbasis website ataupun desktop yang dapat disesuaikan dengan kebutuhan bisnis maupun department anda untuk mempermudah kinerja tim ataupun kolaborasi</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-start mb-5 mt-5">
                <h5 class="mb-4" style="color: #E31E2D; font-size: 3.5rem; font-weight: bold;">Retail Service</h5>
                <p style="color: #666; font-size: 1rem; line-height: 1.4; max-width: 1200px;">
                    Pengembangan perangkat lunak customisasi adalah proses merancang, membuat, menyebarkan, dan memelihara perangkat lunak yang bertujuan agar dapat digunakan dalam sekumpulan pengguna, fungsi, atau organisasi tertentu.
                </p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-gear fs-1 text-danger mb-3"></i>
                            <h4>Content Maintenance</h4>
                            <p class="text-muted">Membangun Website Bisnis maupun Professional dengan teknologi terkini dan tampilan menarik</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-wordpress fs-1 text-danger mb-3"></i>
                            <h4>WordPress Development</h4>
                            <p class="text-muted">Membangun aplikasi mobile berbasis Android maupun iOS sesuai kebutuhan bisnis</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-headset fs-1 text-danger mb-3"></i>
                            <h4>Customer Service</h4>
                            <p class="text-muted">Membangun Software berbasis website atau desktop untuk meningkatkan efisiensi tim</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-people fs-1 text-danger mb-3"></i>
                            <h4>Customer Service</h4>
                            <p class="text-muted">Membangun Software berbasis website atau desktop untuk meningkatkan efisiensi tim</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portofolio" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Portofolio</h2>
            <div class="row g-4">
                <!-- Portfolio items -->
            </div>
        </div>
    </section>

    <!-- Di bagian bawah sebelum closing body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <!-- Modal Edit Logo -->
    <div class="modal fade" id="logoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Logo</h5>
                </div>
                <form action="{{ route('settings.updateLogo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="logo" class="form-label">Pilih Logo Baru</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
