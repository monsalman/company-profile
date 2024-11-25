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
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('portfolio.index') }}" class="btn btn-danger me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="mb-0">{{ $portfolio->title }}</h1>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <img src="{{ asset('storage/' . $portfolio->image) }}" 
                     alt="{{ $portfolio->title }}"
                     class="portfolio-image mb-4">
                
                <div class="portfolio-content">
                    {!! $portfolio->description !!}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 