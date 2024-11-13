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
    </style>
</head>
<body>
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

    <header id="beranda" class="hero-section text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="display-4 fw-bold mb-4">Digitalisasi Bisnis Anda</h1>
                    <p class="lead mb-4">Mengefisiensikan Bisnis Anda dengan menjadikannya terstruktur, termonitor dan tepat sasaran dengan teknologi terkini dan user friendly</p>
                    <div class="d-flex gap-3">
                        <a href="#kontak" class="btn btn-light btn-lg px-4">Mulai Sekarang</a>
                        <a href="#layanan" class="btn btn-outline-light btn-lg px-4">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6">
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
                            <div class="d-flex gap-2 justify-content-center mt-3">
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

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Klien Kami</h2>
            <div class="row align-items-center justify-content-center">
                <div class="col-4 col-md-2 mb-4">
                    <img src="client1.png" alt="Slider Client" class="client-logo w-100">
                </div>
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

    <div class="modal fade" id="manageSliderModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kelola Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="refreshPage()"></button>
                </div>
                <div class="modal-body">
                    <form id="uploadSliderForm" action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-md-8">
                                <label class="form-label">Tambah Gambar Baru</label>
                                <input type="file" class="form-control" name="image" required accept="image/*">
                                <small class="text-muted">Ukuran maksimal: 2MB. Format: JPG, PNG, GIF</small>
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
                                      action="{{ route('slider.destroy', $slider->id) }}" 
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
            
            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                this.reset();
                
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        
                        const sliderList = document.querySelector('.modal-body .row.g-3');
                        const newSliderList = doc.querySelector('.modal-body .row.g-3');
                        sliderList.innerHTML = newSliderList.innerHTML;
                        
                        const carousel = document.querySelector('#heroCarousel .carousel-inner');
                        const newCarousel = doc.querySelector('#heroCarousel .carousel-inner');
                        carousel.innerHTML = newCarousel.innerHTML;
                    });
            })
            .catch(error => {
                console.error('Error:', error);
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
</body>
</html>
