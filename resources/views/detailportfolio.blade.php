<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }} - Digital Forte Indonesia</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . \App\Models\Icon::where('key', 'favicon')->first()?->value ?? 'favicon.png') }}?v={{ time() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .portfolio-image {
            max-height: 500px;
            object-fit: contain;
            width: 100%;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
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

        .content-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        .portfolio-title {
            position: relative;
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
        }

        .portfolio-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 90%;
            height: 3px;
            background-color: #dc3545;
            transform: translateX(-50%);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="content-wrapper">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('portfolio.index') }}" class="btn btn-danger me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1 class="portfolio-title mb-0">{{ $portfolio->title }}</h1>
            </div>

            <div class="mb-4">
                <img src="{{ asset('storage/' . $portfolio->image) }}" 
                     alt="{{ $portfolio->title }}"
                     class="portfolio-image">
            </div>

            <div class="bg-white p-4 rounded-3 shadow-sm">
                <div class="portfolio-content">
                    {!! $portfolio->description !!}
                </div>
            </div>

            @auth
                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <a href="{{ route('portfolio.edit', $portfolio->id) }}" 
                       class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                    <button type="button" 
                            class="btn btn-danger"
                            onclick="confirmDeletePortfolio({{ $portfolio->id }})">
                        <i class="bi bi-trash me-2"></i>Hapus
                    </button>
                </div>
            @endauth
        </div>
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
                    <button type="button" class="btn btn-danger" onclick="deletePortfolio()">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDeletePortfolio(id) {
            const modal = new bootstrap.Modal(document.getElementById('deletePortfolioModal'));
            modal.show();
        }

        function deletePortfolio() {
            fetch(`/portfolio/{{ $portfolio->id }}`, {
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
                    window.location.href = '{{ route("portfolio.index") }}';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html> 