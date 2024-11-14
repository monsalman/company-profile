<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Forte Indonesia</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . \App\Models\Icon::where('key', 'favicon')->first()?->value ?? 'favicon.png') }}?v={{ time() }}">
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
        .hero-content {
            position: relative;
            z-index: 2;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0.1;
            z-index: 1;
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
            transition: all 0.3s ease;
            max-height: 85px;
            width: 100%;
            object-fit: contain;
        }
        .section-title {
            position: relative;
            margin-bottom: 2rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: #E31E2D;
        }
        .modal-backdrop.delete-backdrop {
            z-index: 1080;
        }
        #deleteConfirmationModal {
            z-index: 1085;
        }
        .modal-backdrop.show {
            opacity: 0.8;
            background-color: #000;
        }
        .btn-outline-light:hover {
            color: #dc3545 !important;
        }
        .btn-light {
            color: #dc3545 !important;
            transition: all 0.3s ease;
        }
        .btn-light:hover {
            background-color: transparent !important;
            color: #fff !important;
            border-color: #fff !important;
        }
        .btn-light, .btn-outline-light {
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            z-index: 1;
            border-radius: 30px;
            font-weight: 600;
        }

        .btn-light {
            color: #dc3545 !important;
        }

        .btn-light::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: #dc3545;
            transition: all 0.4s ease;
            z-index: -1;
        }

        .btn-light:hover {
            color: #fff !important;
            /* border-color: #dc3545 !important; */
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-light:hover::before {
            width: 100%;
        }

        .btn-outline-light {
            border: 2px solid #fff;
        }

        .btn-outline-light::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: #fff;
            transition: all 0.4s ease;
            z-index: -1;
        }

        .btn-outline-light:hover {
            color: #dc3545 !important;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .btn-outline-light:hover::before {
            left: 0;
        }

        .btn-light:active, .btn-outline-light:active {
            transform: translateY(-1px);
        }
        .slider-controls {
            position: relative;
            z-index: 3;
        }

        /* Responsive styles */
        @media (max-width: 991.98px) {
            .hero-section {
                padding: 100px 0 60px;
                min-height: auto;
            }
            
            .hero-content {
                text-align: center;
                /* margin-bottom: 40px; */
            }
            
            .hero-content h1 {
                font-size: 2rem !important;
            }
            
            .hero-content .lead {
                font-size: 1rem;
            }
            
            .hero-content .d-flex {
                justify-content: center;
            }
            
            .service-card {
                margin-bottom: 20px;
            }
            
            .btn-light, .btn-outline-light {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 767.98px) {
            .section-title {
                font-size: 1.5rem;
                margin-bottom: 2rem;
            }
            
            h5[style*="font-size: 3.5rem"] {
                font-size: 2rem !important;
            }
            
            .service-card {
                margin-bottom: 15px;
            }
            
            .service-card h4 {
                font-size: 1.2rem;
            }
            
            .service-card p {
                font-size: 0.9rem;
            }
            
            .client-logo {
                max-height: 60px;
                margin: 5px 0;
            }
            
            .navbar-brand img {
                height: 30px;
            }
            
            .modal-dialog {
                margin: 10px;
            }
            
            .client-slide {
                flex: 0 0 200px;
                min-width: 200px;
                padding: 0 5px;
            }
            
            .client-slider {
                gap: 0;
            }
        }

        @media (max-width: 575.98px) {
            .hero-content .d-flex {
                justify-content: center;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                gap: 8px !important;
            }
            
            .btn-light, .btn-outline-light {
                width: auto !important;
                margin: 0 !important;
                padding: 8px 12px !important;
                font-size: 0.8rem !important;
                white-space: nowrap;
                min-width: 0 !important;
            }
            
            .hero-content h1 {
                font-size: 1.8rem !important;
            }
            
            .hero-content .lead {
                font-size: 0.9rem;
                margin-bottom: 1.5rem !important;
            }
        }

        /* Tambahkan breakpoint khusus untuk iPhone SE */
        @media (max-width: 375px) {
            .btn-light, .btn-outline-light {
                padding: 6px 10px !important;
                font-size: 0.75rem !important;
            }
            
            .client-logo {
                max-height: 50px;
            }
            
            .client-slide {
                flex: 0 0 180px;
                min-width: 180px;
                padding: 0 3px;
            }
        }

        .btn-large {
            padding: 15px 30px;
            font-size: 1.25rem;
        }

        .client-slider-container {
            overflow: hidden;
            padding: 20px 0;
            position: relative;
            background: transparent;
        }
        
        .client-slider {
            display: flex;
            animation: slideClient 60s linear infinite;
            gap: 2px;
            width: fit-content;
        }
        
        .client-slide {
            flex: 0 0 250px;
            min-width: 250px;
            padding: 0 10px;
        }
        
        @keyframes slideClient {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(calc(-250px * (var(--slide-count) / 2)));
            }
        }
        
        .client-slider:hover {
            animation-play-state: paused;
        }

        .modal-backdrop.delete-client-backdrop {
            z-index: 1080;
            opacity: 0.8;
            background-color: #000;
        }

        #deleteClientConfirmationModal {
            z-index: 1085;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <div class="d-flex align-items-center">
                <img src="{{ asset('storage/' . \App\Models\Icon::where('key', 'logo')->first()?->value ?? 'logo.png') }}" alt="Logo" height="40">
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

    <header id="beranda" class="hero-section text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content order-2 order-lg-1">
                    <h1 class="fw-bold mb-4" style="font-size: 2.7rem;">Digitalisasi Bisnis Anda</h1>
                    <p class="lead mb-4">Mengefisiensikan Bisnis Anda dengan menjadikannya terstruktur, termonitor dan tepat sasaran dengan teknologi terkini dan user friendly</p>
                    <div class="d-flex gap-3">
                        <a href="#kontak" class="btn btn-light btn-lg px-4 btn-large">Mulai Sekarang</a>
                        <a href="#layanan" class="btn btn-outline-light btn-lg px-4 btn-large">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                    <div class="position-relative">
                        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @forelse($sliderImages as $index => $slider)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100" alt="Slider Image">
                                    </div>
                                @empty
                                    <div class="carousel-item active">
                                        <img src="{{ asset('hero-image.png') }}" class="d-block w-100" alt="Hero Slider">
                                    </div>
                                @endforelse
                            </div>
                            @if($sliderImages->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>

                        @auth
                            <div class="d-flex gap-2 justify-content-center mt-3 slider-controls">
                                <button class="btn btn-warning d-flex align-items-center gap-2 px-4" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#manageSliderModal"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-gear fs-5"></i>
                                    <span>Kelola Slider</span>
                                </button>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-5 bg-light" style="padding-top: 1rem;">
        <div class="container">
            <h2 class="text-center section-title">Klien Kami</h2>
            
            <div class="client-slider-container">
                <div class="client-slider" style="--slide-count: {{ $clientSliders->count() * 2 }}">
                    @forelse($clientSliders as $client)
                        <div class="client-slide">
                            <img src="{{ asset('storage/' . $client->image) }}" 
                                 alt="Client Logo" 
                                 class="client-logo">
                        </div>
                    @empty
                        <div class="client-slide">
                            <img src="client1.png" alt="Default Client" class="client-logo">
                        </div>
                    @endforelse
                    
                    @foreach($clientSliders as $client)
                        <div class="client-slide">
                            <img src="{{ asset('storage/' . $client->image) }}" 
                                 alt="Client Logo" 
                                 class="client-logo">
                        </div>
                    @endforeach
                </div>
                
                @auth
                    <div class="text-center mt-4">
                        <button class="btn btn-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#manageClientModal">
                            <i class="bi bi-gear"></i> Kelola Client
                        </button>
                    </div>
                @endauth
            </div>
        </div>
    </section>

    <section id="layanan" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Layanan Kami</h2>
            
            <div class="text-start mb-5">
                <h5 class="mb-4" style="color: #E31E2D; font-size: 3.5rem; font-weight: bold;">Service Custom Development</h5>
                <p style="color: #666; font-size: 1rem; line-height: 1.4; max-width: 1200px;">
                    Pengembangan perangkat lunak customisasi adalah proses merancang, membuat, menyebarkan, dan memelihara perangkat lunak yang bertujuan agar dapat digunakan dalam sekumpulan pengguna, fungsi, atau organisasi tertentu.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-globe fs-1 text-danger mb-3"></i>
                            <h4>Website Development</h4>
                            <p class="text-muted">Membangun Website Bisnis maupun Professional bagi Bisnis anda dengan teknologi terkini dan tampilan menarik</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-phone fs-1 text-primary mb-3"></i>
                            <h4>Mobile Development</h4>
                            <p class="text-muted">Membangung ataupun mengembangkan aplikasi mobile berbasis android maupun IOS yang dapat disesuaikan dengan kebutuhan bisnis</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
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
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-gear fs-1 text-danger mb-3"></i>
                            <h4>Content Maintenance</h4>
                            <p class="text-muted">Membangun Website Bisnis maupun Professional dengan teknologi terkini dan tampilan menarik</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-wordpress fs-1 text-danger mb-3"></i>
                            <h4>WordPress Development</h4>
                            <p class="text-muted">Membangun aplikasi mobile berbasis Android maupun iOS sesuai kebutuhan bisnis</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="service-card card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-headset fs-1 text-danger mb-3"></i>
                            <h4>Customer Service</h4>
                            <p class="text-muted">Membangun Software berbasis website atau desktop untuk meningkatkan efisiensi tim</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
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

    <section id="portofolio" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Portofolio</h2>
            <div class="row g-4">
            </div>
        </div>
    </section>

    <section id="kontak" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Kontak Kami</h2>
            <!-- Isi konten kontak disini -->
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <div class="modal fade" id="logoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Logo</h5>
                </div>
                <form action="{{ route('icons.updateLogo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Favicon Website</label>
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="position-relative" style="min-height: 32px;">
                                    @php
                                        $faviconSetting = \App\Models\Icon::where('key', 'favicon')->first();
                                    @endphp
                                    
                                    @if($faviconSetting?->value && $faviconSetting->value !== 'favicon.png')
                                        <img id="faviconPreview" 
                                             src="{{ asset('storage/' . $faviconSetting->value) }}" 
                                             alt="Favicon Preview" 
                                             style="height: 32px; width: 32px; object-fit: contain; border-radius: 4px; padding: 2px;">
                                        <button type="button" 
                                                class="btn-close position-absolute top-0 end-0" 
                                                style="transform: translate(25%, -25%); 
                                                       background-color: #dc3545;
                                                       padding: 0.3rem;
                                                       border-radius: 50%;
                                                       box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                                       opacity: 0.9;"
                                                onclick="clearImage('favicon')">
                                        </button>
                                    @else
                                        <img id="faviconPreview" 
                                             src="{{ asset('favicon.png') }}" 
                                             alt="Favicon Preview" 
                                             style="height: 32px; width: 32px; object-fit: contain; border-radius: 4px; padding: 2px;">
                                    @endif
                                </div>
                            </div>
                            <input type="file" 
                                   class="form-control" 
                                   id="favicon" 
                                   name="favicon" 
                                   accept="image/x-icon,image/png,image/jpeg"
                                   onchange="handleFileSelect(event, 'faviconPreview')">
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Website</label>
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="position-relative">
                                    @php
                                        $logoSetting = \App\Models\Icon::where('key', 'logo')->first();
                                    @endphp
                                    
                                    @if($logoSetting?->value && $logoSetting->value !== 'logo.png')
                                        <img id="logoPreview" 
                                             src="{{ asset('storage/' . $logoSetting->value) }}" 
                                             alt="Logo Preview" 
                                             style="height: 50px; width: auto; object-fit: contain; border-radius: 4px; padding: 2px;">
                                        <button type="button" 
                                                class="btn-close position-absolute top-0 end-0" 
                                                style="transform: translate(25%, -25%); 
                                                       background-color: #dc3545;
                                                       padding: 0.3rem;
                                                       border-radius: 50%;
                                                       box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                                       opacity: 0.9;"
                                                onclick="clearImage('logo')"></button>
                                    @else
                                        <img id="logoPreview" 
                                             src="{{ asset('logo.png') }}" 
                                             alt="Logo Preview" 
                                             style="height: 50px; width: auto; object-fit: contain; border-radius: 4px; padding: 2px;">
                                    @endif
                                </div>
                            </div>
                            <input type="file" 
                                   class="form-control" 
                                   id="logo" 
                                   name="logo" 
                                   accept="image/*"
                                   onchange="handleFileSelect(event, 'logoPreview')">
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

    <div class="modal fade" id="manageSliderModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kelola Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="refreshPage()"></button>
                </div>
                <div class="modal-body">
                    <form id="uploadSliderForm" action="{{ route('heroslider.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-md-8">
                                <label class="form-label">Tambah Gambar Baru</label>
                                <input type="file" class="form-control" name="images[]" required accept="image/*" multiple>
                                <small class="text-muted">Ukuran maksimal: 2MB per file. Format: JPG, PNG, GIF. Bisa pilih lebih dari 1 file.</small>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-plus-circle me-2"></i>Upload
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    <h6 class="mb-3">Daftar Gambar Slider</h6>
                    <div class="row g-3">
                        @forelse($sliderImages as $slider)
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $slider->image) }}" 
                                             class="card-img-top" 
                                             alt="Slider"
                                             style="height: 150px; object-fit: cover;">
                                        <button class="btn btn-sm btn-warning position-absolute top-0 end-0 m-2" 
                                                onclick="deleteSlider({{ $slider->id }})"
                                                title="Hapus Slider">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <small class="text-muted">
                                            Ditambahkan: {{ $slider->created_at->diffForHumans(['parts' => 1, 'join' => ' ', 'syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW]) }}
                                        </small>
                                    </div>
                                </div>
                                <form id="delete-form-{{ $slider->id }}" 
                                      action="{{ route('heroslider.destroy', $slider->id) }}" 
                                      method="POST" 
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info mb-0">
                                    Belum ada gambar slider. Silakan tambahkan gambar baru.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus gambar ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    let currentSliderId = null;
    let deleteModal = null;
    let manageModal = null;

    document.addEventListener('DOMContentLoaded', function() {
        deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        manageModal = new bootstrap.Modal(document.getElementById('manageSliderModal'));
        
        document.getElementById('confirmDelete').addEventListener('click', function() {
            const form = document.getElementById('delete-form-' + currentSliderId);
            
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                closeDeleteModal();
                
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        
                        const sliderList = document.querySelector('.modal-body .row.g-3');
                        const newSliderList = doc.querySelector('.modal-body .row.g-3');
                        sliderList.innerHTML = newSliderList.innerHTML;
                    });
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        document.getElementById('uploadSliderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                this.reset();
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Upload';
                
                if (data.success) {
                    // Refresh tampilan
                    fetch(window.location.href)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            
                            // Update daftar slider di modal
                            const sliderList = document.querySelector('.modal-body .row.g-3');
                            const newSliderList = doc.querySelector('.modal-body .row.g-3');
                            sliderList.innerHTML = newSliderList.innerHTML;
                            
                            // Update carousel di halaman
                            const carousel = document.querySelector('#heroCarousel .carousel-inner');
                            const newCarousel = doc.querySelector('#heroCarousel .carousel-inner');
                            carousel.innerHTML = newCarousel.innerHTML;
                        });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Upload';
            });
        });
    });

    function deleteSlider(id) {
        currentSliderId = id;
        deleteModal.show();
        document.querySelector('.modal-backdrop:last-child').classList.add('delete-backdrop');
    }

    function closeDeleteModal() {
        deleteModal.hide();
    }

    function refreshPage() {
        window.location.reload();
    }
    </script>

    <script>
    function handleFileSelect(event, previewId) {
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);
        const type = previewId.replace('Preview', ''); // favicon atau logo
        const closeButton = preview.parentElement.querySelector('.btn-close');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                
                // Tambahkan tombol close jika belum ada
                if (!closeButton) {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'btn-close position-absolute top-0 end-0';
                    button.style.cssText = `
                        transform: translate(25%, -25%);
                        background-color: #dc3545;
                        padding: 0.3rem;
                        border-radius: 50%;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                        opacity: 0.9;
                    `;
                    button.onclick = () => clearImage(type);
                    preview.parentElement.appendChild(button);
                } else {
                    closeButton.style.display = 'block';
                }
            };
            reader.readAsDataURL(file);
        }
    }

    function clearImage(type) {
        const preview = document.getElementById(`${type}Preview`);
        const input = document.getElementById(type);
        const closeButton = preview.parentElement.querySelector('.btn-close');
        
        // Reset preview ke gambar default
        preview.src = type === 'favicon' ? "{{ asset('favicon.png') }}" : "{{ asset('logo.png') }}";
        
        // Clear input file
        input.value = '';
        
        // Sembunyikan tombol close
        if (closeButton) {
            closeButton.style.display = 'none';
        }
        
        // Tambahkan hidden input untuk menandai penghapusan
        const existingHidden = input.parentNode.querySelector(`input[name="remove_${type}"]`);
        if (existingHidden) {
            existingHidden.remove();
        }
        
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = `remove_${type}`;
        hiddenInput.value = '1';
        input.parentNode.appendChild(hiddenInput);
    }

    // Event handler untuk form submit
    document.querySelector('#logoModal form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update favicon di browser
                const faviconLink = document.querySelector('link[rel="icon"]');
                if (faviconLink) {
                    const newPath = data.favicon_removed ? 
                        "{{ asset('favicon.png') }}" : 
                        "{{ asset('storage/') }}/" + (data.favicon_path || faviconLink.href.split('?')[0].split('/').pop());
                    faviconLink.href = newPath + "?v=" + data.timestamp;
                }
                
                // Tutup modal
                const modal = document.getElementById('logoModal');
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                }

                // Refresh halaman setelah modal tertutup
                setTimeout(() => {
                    window.location.reload();
                }, 300); // Delay 300ms untuk memastikan modal tertutup dengan mulus
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    </script>

    <div class="modal fade" id="manageClientModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kelola Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="refreshPage()"></button>
                </div>
                <div class="modal-body">
                    <form id="uploadClientForm" action="{{ route('clientslider.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-md-8">
                                <label class="form-label">Tambah Logo Client</label>
                                <input type="file" class="form-control" name="images[]" required accept="image/*" multiple>
                                <small class="text-muted">Ukuran maksimal: 2MB per file. Format: JPG, PNG, GIF. Bisa pilih lebih dari 1 file.</small>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-plus-circle me-2"></i>Upload
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    <h6 class="mb-3">Daftar Logo Client</h6>
                    <div class="row g-3">
                        @forelse($clientSliders as $client)
                            <div class="col-md-4" data-client-id="{{ $client->id }}">
                                <div class="card h-100">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $client->image) }}" 
                                             class="card-img-top p-2" 
                                             alt="Client Logo"
                                             style="height: 100px; object-fit: contain;">
                                        <button class="btn btn-sm btn-warning position-absolute top-0 end-0 m-2" 
                                                onclick="deleteClient({{ $client->id }})"
                                                title="Hapus Client">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <small class="text-muted">
                                            Ditambahkan: {{ $client->created_at->diffForHumans(['parts' => 1, 'join' => ' ', 'syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW]) }}
                                        </small>
                                    </div>
                                </div>
                                <form id="delete-client-form-{{ $client->id }}" 
                                      action="{{ route('clientslider.destroy', $client->id) }}" 
                                      method="POST" 
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info mb-0">
                                    Belum ada logo client. Silakan tambahkan logo baru.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteClientConfirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus logo client ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteClient">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    let currentClientId = null;
    let deleteClientModal = null;
    let manageClientModal = null;

    document.addEventListener('DOMContentLoaded', function() {
        deleteClientModal = new bootstrap.Modal(document.getElementById('deleteClientConfirmationModal'));
        manageClientModal = new bootstrap.Modal(document.getElementById('manageClientModal'));
        
        document.getElementById('confirmDeleteClient').addEventListener('click', function() {
            if (currentClientId) {
                const form = document.getElementById('delete-client-form-' + currentClientId);
                
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Tutup modal
                        deleteClientModal.hide();
                        
                        // Refresh tampilan
                        const clientElement = document.querySelector(`[data-client-id="${currentClientId}"]`);
                        if (clientElement) {
                            clientElement.remove();
                        }
                        
                        // Reset currentClientId
                        currentClientId = null;
                        
                        // Refresh halaman untuk memperbarui tampilan
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });

        document.getElementById('uploadClientForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                this.reset();
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Upload';
                
                if (data.success) {
                    // Refresh tampilan
                    fetch(window.location.href)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            
                            // Update daftar client di modal
                            const clientList = document.querySelector('#manageClientModal .row.g-3');
                            const newClientList = doc.querySelector('#manageClientModal .row.g-3');
                            clientList.innerHTML = newClientList.innerHTML;
                            
                            // Update slider client di halaman
                            const clientSlider = document.querySelector('.client-slider');
                            const newClientSlider = doc.querySelector('.client-slider');
                            clientSlider.innerHTML = newClientSlider.innerHTML;
                        });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Upload';
            });
        });
    });

    function deleteClient(id) {
        currentClientId = id;
        deleteClientModal.show();
        document.querySelector('.modal-backdrop:last-child').classList.add('delete-client-backdrop');
    }

    function closeDeleteClientModal() {
        deleteClientModal.hide();
        currentClientId = null;
    }
    </script>
</body>
</html>
