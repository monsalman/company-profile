<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . \App\Models\Icon::where('key', 'favicon')->first()?->value ?? 'favicon.png') }}?v={{ time() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-page {
            text-align: center;
            padding: 2rem;
        }
        .error-message {
            font-size: 1.6rem;
            color: #666;
            margin-bottom: 2rem;
        }
        .error-code {
            color: #dc3545;
            font-weight: bold;
        }
        .logo {
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-page">
            <div class="logo">
                <img src="{{ asset('storage/' . \App\Models\Icon::where('key', 'logo')->first()?->value ?? 'logo.png') }}" 
                     alt="Logo" 
                     height="60">
            </div>
            <div class="error-message">
                <span class="error-code">404</span> | Halaman Tidak Ditemukan
            </div>
            <a href="{{ url('/') }}" class="btn btn-danger btn-lg px-4">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html> 