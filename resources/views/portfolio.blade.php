<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - Digital Forte Indonesia</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . \App\Models\Icon::where('key', 'favicon')->first()?->value ?? 'favicon.png') }}?v={{ time() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .portfolio-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .portfolio-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.2);
        }

        .portfolio-image-container {
            aspect-ratio: 4/3;
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 100%;
        }

        .portfolio-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .portfolio-description {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 200px;
            line-height: 1.5;
        }

        .back-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .back-button:hover {
            transform: translateY(-3px);
        }

        .section-title {
            position: relative;
            padding-bottom: 0.3rem;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            width: 90%;
            height: 3px;
            background-color: #dc3545;
        }

        .modal-content {
            border: none;
            border-radius: 15px;
        }

        .modal-header {
            border-bottom: 2px solid #f8f9fa;
        }

        .modal-footer {
            border-top: 2px solid #f8f9fa;
        }

        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 12px 15px;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex align-items-center mb-5">
            <a href="{{ route('home') }}" class="btn btn-danger me-3" title="Kembali ke Beranda">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="section-title mb-0">Portofolio Kami</h1>
        </div>
        
        <div class="row">
            @forelse($portfolios as $portfolio)
                <div class="col-12 mb-4">
                    <div class="portfolio-card card">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex align-items-center">
                                <div class="portfolio-image-container">
                                    <img src="{{ asset('storage/' . $portfolio->image) }}" 
                                         class="portfolio-image"
                                         alt="{{ $portfolio->title }}"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#portfolioModal{{ $portfolio->id }}"
                                         style="cursor: pointer;">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body h-100 d-flex flex-column">
                                    <h5 class="card-title fw-bold">{{ $portfolio->title }}</h5>
                                    <div class="portfolio-description mb-3 mt-3">
                                        {!! Str::limit($portfolio->description, 200, '...') !!}
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <button class="btn btn-outline-danger btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#portfolioModal{{ $portfolio->id }}">
                                            Baca Selengkapnya
                                        </button>
                                        @auth
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('portfolio.edit', $portfolio->id) }}" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="confirmDeletePortfolio({{ $portfolio->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada portofolio yang ditambahkan
                    </div>
                </div>
            @endforelse
        </div>

        @auth
            <div class="text-center mt-4">
                <a href="{{ route('portfolio.create') }}" class="btn btn-danger">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Portofolio
                </a>
            </div>
        @endauth
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div class="modal fade" id="deletePortfolioModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus portofolio ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="deletePortfolio()">
                        <i class="bi bi-trash me-2"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-danger rounded-circle back-to-top" id="backToTop" title="Kembali ke atas">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentPortfolioId = null;

        function confirmDeletePortfolio(id) {
            currentPortfolioId = id;
            const modal = new bootstrap.Modal(document.getElementById('deletePortfolioModal'));
            modal.show();
        }

        function deletePortfolio() {
            if (!currentPortfolioId) return;

            fetch(`/portfolio/${currentPortfolioId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Tutup modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deletePortfolioModal'));
                    modal.hide();
                    
                    // Hapus elemen dari DOM
                    const portfolioElement = document.querySelector(`[data-portfolio-id="${currentPortfolioId}"]`);
                    if (portfolioElement) {
                        portfolioElement.remove();
                    }

                    // Refresh halaman setelah berhasil menghapus
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Script untuk back to top button
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) { // Muncul setelah scroll 300px
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth' // Smooth scroll ke atas
            });
        });
    </script>
</body>
</html>
