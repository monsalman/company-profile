<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \App\Models\PageTitle::where('key', 'homepage')->first()?->value ?? 'Belum di konfigurasi' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . \App\Models\Icon::where('key', 'favicon')->first()?->value ?? 'favicon.png') }}?v={{ time() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            max-height: 100%;
            max-width: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            padding: 1px;
        }
        .section-title {
            position: relative;
            margin-bottom: 2rem;
            font-size: 1.5rem;
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

        @media (max-width: 991.98px) {
            .hero-section {
                padding: 100px 0 60px;
                min-height: auto;
            }
            
            .hero-content {
                text-align: center;
            }
            
            .hero-content h1 {
                font-size: 2rem !important;
            }
            
            .hero-content .lead {
                font-size: 1rem;
            }
            
            .hero-content .d-flex {
                justify-content: center;
                gap: 15px;
                width: 100%;
                align-items: center;
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
                font-size: 1.5rem !important;
                line-height: 1.2 !important;
                white-space: nowrap !important;
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
            padding: 10px 24px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        @media (max-width: 991.98px) {
            .btn-large {
                padding: 15px 30px;
                font-size: 1.25rem;
            }
        }

        @media (max-width: 575.98px) {
            .hero-content .d-flex {
                justify-content: center;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                gap: 8px !important;
            }
            
            .btn-large {
                padding: 12px 20px !important;
                font-size: 1rem !important;
                white-space: nowrap;
                min-width: 0 !important;
            }
        }

        @media (max-width: 375px) {
            .btn-large {
                padding: 10px 16px !important;
                font-size: 0.9rem !important;
            }
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
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .offcanvas {
            width: 280px !important;
        }

        .offcanvas-header {
            padding: 1.5rem;
            background: #dc3545;
        }

        .offcanvas-title {
            color: white;
            font-weight: 600;
        }

        .offcanvas .nav-link {
            padding: 0.8rem 1.5rem;
            color: #333;
            font-weight: 500;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .offcanvas .nav-link:hover {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            padding-left: 1.8rem;
        }

        .offcanvas .nav-link.active {
            color: #dc3545;
            background: rgba(220, 53, 69, 0.1);
        }

        .navbar-toggler {
            border: none;
            padding: 0;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            width: 24px;
            height: 24px;
        }

        .navbar-nav .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: #dc3545;
            transition: width 0.3s ease;
            border-radius: 3px;
        }

        .navbar-nav .nav-link:hover {
            color: #dc3545;
        }

        .navbar-nav .nav-link.active::after {
            width: 100%;
        }

        .navbar-nav .nav-link.active {
            color: #dc3545;
        }

        .navbar-nav .nav-link {
            border: none !important;
            background: none !important;
            position: relative;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus,
        .navbar-nav .nav-link:active,
        .navbar-nav .nav-link.active {
            background: none !important;
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: #dc3545;
            transition: width 0.3s ease;
            border-radius: 3px;
        }

        .navbar-nav .nav-link.active::after,
        .navbar-nav .nav-link.active:hover::after {
            width: 100%;
        }

        .navbar-nav .nav-link:hover {
            color: #dc3545;
        }

        .navbar-nav .nav-link.active {
            color: #dc3545;
        }

        html {
            scroll-behavior: smooth;
        }

        section {
            scroll-margin-top: 70px;
        }

        @media (max-width: 768px) {
            .nav-link:active::after {
                width: 100%;
            }
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-link {
            position: relative;
            padding: 0.5rem 1rem !important;
            color: #333 !important;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .nav-link i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .nav-link:hover i {
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #dc3545;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #dc3545 !important;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                border-radius: 10px;
                padding: 1rem;
                margin-top: 1rem;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            }

            .nav-link {
                padding: 0.8rem 1rem !important;
                border-radius: 5px;
            }

            .nav-link:hover {
                background: rgba(220, 53, 69, 0.1);
            }
        }

        .navbar-nav .nav-link:not(.active):hover::after {
            width: 0;
        }

        .nav-button-logout {
            color: #333;
            font-weight: 500;
            text-decoration: none;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
            border: none;
            background: none;
            display: flex;
            align-items: center;
        }

        .nav-button-logout:hover {
            color: #dc3545;
        }

        .nav-button-logout i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .nav-button-logout:hover i {
            transform: translateY(-2px);
        }

        /* Tambahkan style untuk backdrop gelap */
        .modal-backdrop.delete-selected-backdrop {
            opacity: 0.8;
            background-color: #000;
            z-index: 1080;
        }

        #deleteSelectedSlidersConfirmationModal {
            z-index: 1085;
        }

        .modal-dialog {
            position: relative;
            z-index: 1090;
        }

        .form-check-input:checked {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .card.selected {
            border: 2px solid #dc3545 !important;
        }

        .card.selected .card-footer {
            background-color: #dc3545 !important;
            border-top-color: #dc3545 !important;
            transition: all 0.3s ease;
        }

        .card.selected .card-footer small {
            color: #fff !important;
        }

        .form-check-input:focus {
            box-shadow: none !important;
            outline: none !important;
            border-color: #dc3545 !important;
        }

        .form-check-input {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #dee2e6 !important;
        }

        .form-check-input:focus {
            border-color: #dee2e6 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }

        .form-check-input:checked {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .form-check-input:checked:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }

        .form-check-input:hover {
            border-color: #dc3545 !important;
        }

        .btn:disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .loading-text, .normal-text {
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .d-none {
            display: none !important;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse .nav-link {
                position: relative;
                transition: all 0.3s ease;
                padding: 0.8rem 1rem !important;
                border-radius: 5px;
            }

            .navbar-collapse .nav-link::after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                bottom: 0;
                left: 0;
                background-color: #dc3545;
                transition: width 0.3s ease;
            }

            .navbar-collapse .nav-link:hover,
            .navbar-collapse .nav-link:active,
            .navbar-collapse .nav-link.active {
                background-color: rgba(220, 53, 69, 0.1);
                color: #dc3545 !important;
                padding-left: 1.5rem !important;
            }

            .navbar-collapse .nav-link:hover::after,
            .navbar-collapse .nav-link:active::after,
            .navbar-collapse .nav-link.active::after {
                width: 100%;
            }

            .navbar-collapse .nav-link i {
                transition: transform 0.3s ease;
            }

            .navbar-collapse .nav-link:hover i,
            .navbar-collapse .nav-link:active i,
            .navbar-collapse .nav-link.active i {
                transform: translateX(5px);
            }
        }

        @media (max-width: 991.98px) {
            .nav-link {
                position: relative;
                transition: all 0.3s ease;
                padding: 0.8rem 1rem !important;
                border-radius: 5px;
            }

            .nav-link.active {
                background-color: rgba(220, 53, 69, 0.1);
                color: #dc3545 !important;
                padding-left: 1.5rem !important;
            }

            .nav-link.active i {
                transform: translateX(5px);
            }

            .nav-link::after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                bottom: 0;
                left: 0;
                background-color: #dc3545;
                transition: width 0.3s ease;
            }

            .nav-link.active::after {
                width: 100%;
            }

            .nav-link i {
                transition: transform 0.3s ease;
            }
        }

        #deleteSelectedConfirmationModal,
        #deleteSelectedSlidersConfirmationModal {
            z-index: 1085;
        }

        .modal-backdrop.delete-selected-backdrop,
        .modal-backdrop.delete-selected-sliders-backdrop {
            opacity: 0.8;
            background-color: #000;
            z-index: 1080;
        }

        .modal-dialog {
            position: relative;
            z-index: 1090;
        }

        .modal-backdrop.delete-confirmation-backdrop {
            opacity: 0.8;
            background-color: #000;
            z-index: 1080;
        }

        #deleteConfirmationModal {
            z-index: 1085;
        }

        .modal-dialog {
            position: relative;
            z-index: 1090;
        }

        .modal.fade.show.dim-background {
            background-color: rgba(0, 0, 0, 0.9) !important;
        }

        .modal.fade.show.dim-background .modal-content {
            opacity: 1 !important;
            background-color: #fff !important;
        }

        #deleteSelectedConfirmationModal {
            z-index: 1060;
        }

        #deleteSelectedConfirmationModal .modal-dialog {
            z-index: 1070;
        }

        .modal-backdrop.delete-confirmation-backdrop {
            opacity: 0.9 !important; 
            background-color: rgba(0, 0, 0, 0.9) !important;
            z-index: 1055;
        }

        #tentang {
            background-color: #fff;
        }

        #tentang p {
            text-align: justify;
            margin-bottom: 1.5rem;
        }

        #tentang h3 {
            margin-bottom: 2rem;
        }

        .vision-card,
        .mission-card {
            position: relative;
            transition: all 0.3s ease;
            height: 80px; 
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(227, 30, 45, 0.1);
        }

        .card-description {
            position: absolute;
            top: 60px;
            left: 0;
            right: 0;
            padding: 0 1.5rem;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .vision-card:hover,
        .mission-card:hover {
            height: 200px;
            box-shadow: 0 8px 16px rgba(227, 30, 45, 0.2) !important; 
        }

        .vision-card:hover .card-description,
        .mission-card:hover .card-description {
            opacity: 1;
            transform: translateY(0);
        }

        .row {
            align-items: flex-start;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .vision-card:hover .card-description,
        .mission-card:hover .card-description {
            animation: slideDown 0.3s ease forwards;
        }

        .vision-card .card-body,
        .mission-card .card-body {
            padding: 1rem 1.5rem !important;
        }

        .card-description p {
            margin-top: 0.5rem !important; 
            margin-bottom: 0.5rem !important; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <div class="d-flex align-items-center">
                <img src="{{ asset('storage/' . \App\Models\Icon::where('key', 'logo')->first()?->value ?? 'logo.png') }}" 
                     alt="Logo" 
                     height="40">
                @auth
                    <a href="#" class="ms-2 text-white d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#logoModal">
                        <i class="bi bi-pencil-square text-danger me-1"></i>
                        <span class="text-danger" style="font-size: 14px;">Edit Logo</span>
                    </a>
                    <a href="#" class="ms-2 text-white d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#pageTitlesModal">
                        <i class="bi bi-gear text-danger me-1"></i>
                        <span class="text-danger" style="font-size: 14px;">Edit Title</span>
                    </a>
                @endauth
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#beranda"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan"><i class="bi bi-gear me-1"></i>Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio"><i class="bi bi-briefcase me-1"></i>Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang"><i class="bi bi-person me-1"></i>Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#informasi"><i class="bi bi-info-circle me-1"></i>Informasi</a></li>
                    @auth
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-button-logout">
                                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>

            <button class="navbar-toggler d-lg-none border-0 d-flex align-items-center gap-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                <i class="bi bi-list text-danger fs-4"></i>
                <span class="text-danger" style="font-size: 14px;">Menu</span>
            </button>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#beranda">
                        <i class="bi bi-house-door me-2"></i>Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#layanan">
                        <i class="bi bi-gear me-2"></i>Layanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">
                        <i class="bi bi-briefcase me-2"></i>Portfolio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">
                        <i class="bi bi-person me-2"></i>Tentang Kami
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#informasi">
                        <i class="bi bi-info-circle me-2"></i>Informasi
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-button-logout">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>

    <header id="beranda" class="hero-section text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content order-2 order-lg-1">
                @php
                        $heroContent = \App\Models\HeroContent::first();
                    @endphp
                    <h1 class="fw-bold mb-4" style="font-size: 3rem;">
                        {{ $heroContent?->title ?? 'Belum di konfigurasi' }}
                        @auth
                            <a href="#" class="ms-2 text-white" style="font-size: 1.5rem;" data-bs-toggle="modal" data-bs-target="#heroContentModal">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        @endauth
                    </h1>
                    <p class="lead mb-4">
                        {{ $heroContent?->description ?? 'Belum di konfigurasi' }}
                    </p>
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

    <section class="py-5 bg-light" style="padding-top: 1rem !important;">
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
                        <div class="client-slide"></div>
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

    <section id="layanan" class="py-5" style="padding-top: 0 !important;">
        <div class="container">
            <h2 class="text-center section-title" style="margin-top: 10px;">Layanan Kami</h2>
            
            <div class="text-start mb-5">
                <h5 class="mb-4" style="color: #E31E2D; font-size: 3.5rem; font-weight: bold;">
                    {{ \App\Models\Layanan::where('key', 'service_custom')->first()?->title ?? 'Belum di konfigurasi' }}
                    @auth
                        <a href="#" class="ms-2 text-danger" style="font-size: 2rem;" data-bs-toggle="modal" data-bs-target="#layananModal">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    @endauth
                </h5>
                <p style="color: #666; font-size: 1rem; line-height: 1.4; max-width: 1200px;">
                    {{ \App\Models\Layanan::where('key', 'service_custom')->first()?->description ?? 'Belum di konfigurasi' }}
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse($serviceCards as $card)
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card card">
                            <div class="card-body text-center p-4">
                                <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}" class="mb-3" style="height: 150px; width: auto;">
                                <h4>{{ $card->title }}</h4>
                                <p class="text-muted">{{ $card->description }}</p>
                                @auth
                                    <div class="mt-3">
                                        <button type="button" 
                                                class="btn btn-sm btn-warning me-2" 
                                                onclick="editServiceCard('{{ $card->id }}', '{{ $card->title }}', '{{ $card->description }}', '{{ asset('storage/' . $card->image) }}')"
                                                title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="deleteServiceCard('{{ $card->id }}')"
                                                title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Belum ada service card
                        </div>
                    </div>
                @endforelse
            </div>

            @auth
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-warning" onclick="showAddServiceCardModal()">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Service Card
                    </button>
                </div>
            @endauth

            <div class="text-start mb-5 mt-5">
                <h5 class="mb-4" style="color: #E31E2D; font-size: 3.5rem; font-weight: bold;">
                    {{ \App\Models\Layanan::where('key', 'service_retail')->first()?->title ?? 'Belum di konfigurasi' }}
                    @auth
                        <a href="#" class="ms-2 text-danger" style="font-size: 2rem;" data-bs-toggle="modal" data-bs-target="#retailServiceModal">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    @endauth
                </h5>
                <p style="color: #666; font-size: 1rem; line-height: 1.4; max-width: 1200px;">
                    {{ \App\Models\Layanan::where('key', 'service_retail')->first()?->description ?? 'Belum di konfigurasi' }}
                </p>
            </div>
            
            <div class="row g-4 justify-content-center">
                @forelse($retailServices as $service)
                    <div class="col-12 col-md-6 col-lg-3"> 
                        <div class="service-card card">
                            <div class="card-body text-center p-4">
                                <img src="{{ asset('storage/' . $service->image) }}" 
                                     alt="{{ $service->title }}" 
                                     class="mb-3" 
                                     style="height: 100px; width: auto;">
                                <h4 style="font-size: 1.5rem;">{{ $service->title }}</h4>
                                <p class="text-muted" style="font-size: 1rem;">{{ $service->description }}</p>
                                @auth
                                    <div class="mt-3">
                                        <button type="button" 
                                                class="btn btn-sm btn-warning me-2" 
                                                onclick="editRetailServiceCard('{{ $service->id }}', '{{ urlencode($service->title) }}', '{{ urlencode($service->description) }}', '{{ urlencode(asset('storage/' . $service->image)) }}')"
                                                title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="deleteRetailServiceCard('{{ $service->id }}')"
                                                title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Belum ada retail service
                        </div>
                    </div> 
                @endforelse
            </div>
            
            @auth
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-warning" onclick="showAddRetailServiceCardModal()">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Retail Card
                    </button>
                </div>
            @endauth
        </div>
    </section>

    <section id="portfolio" class="py-3 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Portofolio</h2>
            
            
            <div class="row g-4 justify-content-center">
                @forelse($portfolios as $portfolio)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $portfolio->image) }}" 
                        class="card-img-top" 
                        alt="{{ $portfolio->title }}"
                        style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $portfolio->title }}</h5>
                                <p class="card-text">
                                {!! Str::limit($portfolio->description, 100, '...') !!}
                                    @if (strlen($portfolio->description) > 100)
                                        <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="text-danger">See More</a>
                                    @endif
                                </p>
                            </div>
                            @auth
                                <div class="card-footer bg-white border-0 pb-3">
                                    <div class="d-flex gap-2 justify-content-end">
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
                                </div>
                                @endauth
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                Belum ada portofolio
                            </div>
                        </div>
                        @endforelse

                        <div class="text-center mb-4">
                            @if($portfolios->count() >= 3)
                                <a href="{{ route('portfolio.index') }}" class="btn btn-outline-danger mb-3">
                                    <i class="bi bi-collection me-2"></i>Lihat Semua Portofolio
                                </a>
                            @endif
                            @auth
                            <div>
                                <a href="{{ route('portfolio.create') }}" class="btn btn-warning">
                                    <i class="bi bi-plus-circle me-2"></i>Tambah Portofolio
                                </a>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
    </section>

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

    <section id="tentang" class="py-3">
        <div class="container">
            <h2 class="text-center section-title">Tentang Kami</h2>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h3 class="mb-4" style="color: #E31E2D; font-size: 2rem; font-weight: bold;">
                            {{ \App\Models\ProfileKami::first()?->title ?? 'Belum di konfigurasi' }}
                            @auth
                                <a href="#" class="ms-2 text-danger" style="font-size: 2rem;" data-bs-toggle="modal" data-bs-target="#profilekamiModal">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            @endauth
                        </h3>
                        
                        <p class="mb-4" style="color: #666; font-size: 1rem; line-height: 1.4; max-width: 1200px;">
                            {{ \App\Models\ProfileKami::first()?->description_1 ?? 'Belum di konfigurasi' }}
                        </p>
                        
                        <p class="mb-3" style="color: #666; font-size: 1rem; line-height: 1.4; max-width: 1200px;">
                            {{ \App\Models\ProfileKami::first()?->description_2 ?? 'Belum di konfigurasi' }}
                        </p>

                        <div class="row g-4 mt-3">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm vision-card">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-eye-fill text-danger me-3" style="font-size: 2rem;"></i>
                                            <h4 class="card-title mb-0" style="color: #E31E2D; font-weight: bold;">
                                                Visi
                                            </h4>
                                        </div>
                                        <div class="card-description">
                                            <p class="card-text mt-3" style="color: #666; font-size: 1rem; line-height: 1.6; text-align: left;">
                                                {{ \App\Models\VisiMisi::where('key', 'visi')->first()?->content ?? 'Belum di konfigurasi' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mission-card">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-bullseye text-danger me-3" style="font-size: 2rem;"></i>
                                            <h4 class="card-title mb-0" style="color: #E31E2D; font-weight: bold;">
                                                Misi
                                            </h4>
                                        </div>
                                        <div class="card-description">
                                            <p class="card-text mt-3" style="color: #666; font-size: 1rem; line-height: 1.6; text-align: left;">
                                                {{ \App\Models\VisiMisi::where('key', 'misi')->first()?->content ?? 'Belum di konfigurasi' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @auth
        <div class="text-center">
            <button type="button" 
                    class="btn btn-warning d-flex align-items-center gap-2 mx-auto" 
                    data-bs-toggle="modal" 
                    data-bs-target="#visiMisiModal">
                <i class="bi bi-pencil-square"></i>
                <span>Edit Visi & Misi</span>
            </button>
        </div>
    @endauth

    <section id="kontak" class="py-3">
        <div class="container">
            <h2 class="text-center section-title">Kontak Kami</h2>
        </div>
    </section>

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
                        <button type="submit" class="btn btn-danger"><i class="bi bi-save me-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="manageSliderModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Slider Image</h5>
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
                                    <i class="bi bi-upload me-2"></i>Upload
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Daftar Gambar Slider</h6>
                        <div class="d-flex gap-2">
                            <button type="button" 
                                    class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2" 
                                    id="selectAllSliderBtn"
                                    onclick="toggleSelectAllSliders()">
                                <i class="bi bi-check-all"></i>
                                <span>Pilih Semua</span>
                            </button>
                            <button type="button" 
                                    class="btn btn-danger btn-sm d-flex align-items-center gap-2" 
                                    id="deleteSelectedSlidersBtn" 
                                    style="display: none;"
                                    onclick="confirmDeleteSelectedSliders()">
                                <i class="bi bi-trash"></i>
                                <span>Hapus Terpilih (<span id="selectedSliderCount">0</span>)</span>
                            </button>
                        </div>
                    </div>

                    <div class="row g-3">
                        @forelse($sliderImages as $slider)
                            <div class="col-md-4" data-slider-id="{{ $slider->id }}">
                                <div class="card h-100" onclick="toggleSliderCheckbox(event, {{ $slider->id }})">
                                    <div class="position-relative">
                                        <div class="position-absolute top-0 start-0 m-2">
                                            <input type="checkbox" 
                                                   class="form-check-input slider-checkbox" 
                                                   value="{{ $slider->id }}"
                                                   style="transform: scale(1.2);"
                                                   onclick="handleCheckboxClick(event, this)">
                                        </div>
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
                                            Ditambahkan: {{ $slider->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
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

    <div class="modal fade" id="deleteSelectedSlidersConfirmationModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus <span id="selectedSlidersCount">0</span> gambar slider yang dipilih?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeDeleteSlidersConfirmation()">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteSlidersBtn" onclick="deleteSelectedSliders()">
                        <i class="bi bi-trash me-2"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus gambar ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update modal Edit Hero Content -->
    <div class="modal fade" id="heroContentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Hero Content</h5>
                </div>
                <form action="{{ route('hero-content.update') }}" method="POST" id="heroContentForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" 
                                   value="{{ $heroContent?->title ?? 'Digitalisasi Bisnis Anda' }}" 
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" required>{{ $heroContent?->description ?? 'Mengefisiensikan Bisnis Anda dengan menjadikanya terstruktur, termonitor dan tepat sasaran. Digital Forte Membantu banyak pelaku usaha dengan teknologi terkini dan user friendly' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-save me-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                                    <i class="bi bi-upload me-2"></i>Upload
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Daftar Logo Client</h6>
                        <div class="d-flex gap-2">
                            <button type="button" 
                                    class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2" 
                                    id="selectAllBtn"
                                    onclick="toggleSelectAll()">
                                <i class="bi bi-check-all"></i>
                                <span>Pilih Semua</span>
                            </button>
                            <button type="button" 
                                    class="btn btn-danger btn-sm d-flex align-items-center gap-2" 
                                    id="deleteSelectedBtn" 
                                    style="display: none;"
                                    onclick="confirmDeleteSelected()">
                                <i class="bi bi-trash"></i>
                                <span>Hapus Terpilih (<span id="selectedItemCount">0</span>)</span>
                            </button>
                        </div>
                    </div>

                    <div class="row g-3">
                        @forelse($clientSliders as $client)
                            <div class="col-md-4" data-client-id="{{ $client->id }}">
                                <div class="card h-100" onclick="toggleCheckbox(event, {{ $client->id }})">
                                    <div class="position-relative">
                                        <div class="position-absolute top-0 start-0 m-2">
                                            <input type="checkbox" 
                                                   class="form-check-input client-checkbox" 
                                                   value="{{ $client->id }}"
                                                   style="transform: scale(1.2);"
                                                   onclick="event.stopPropagation()">
                                        </div>
                                        
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
                                            Ditambahkan: {{ $client->created_at->diffForHumans() }}
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

    <div class="modal fade" id="pageTitlesModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Page Title</h5>
                </div>
                <form action="{{ route('page-titles.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Homepage Title</label>
                            <input type="text" class="form-control" name="homepage_title" 
                                   value="{{ \App\Models\PageTitle::where('key', 'homepage')->first()?->value ?? 'Digital Forte Indonesia' }}" 
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Login Page Title</label>
                            <input type="text" class="form-control" name="login_title" 
                                   value="{{ \App\Models\PageTitle::where('key', 'login')->first()?->value ?? 'Login - Digital Forte Indonesia' }}" 
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">404 Page Title</label>
                            <input type="text" class="form-control" name="error_404_title" 
                                   value="{{ \App\Models\PageTitle::where('key', 'error_404')->first()?->value ?? '404 - Halaman Tidak Ditemukan' }}" 
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-save me-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="layananModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Layanan</h5>
                </div>
                <form action="{{ route('layanan.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" 
                                   value="{{ \App\Models\Layanan::where('key', 'service_custom')->first()?->title ?? 'Service Custom Development' }}" 
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="4" required>{{ \App\Models\Layanan::where('key', 'service_custom')->first()?->description ?? 'Pengembangan perangkat lunak customisasi adalah proses merancang, membuat, menyebarkan, dan memelihara perangkat lunak yang bertujuan agar dapat digunakan dalam sekumpulan pengguna, fungsi, atau organisasi tertentu.' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-save me-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="retailServiceModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Retail</h5>
                </div>
                <form action="{{ route('layanan.update-retail') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" 
                                   value="{{ \App\Models\Layanan::where('key', 'service_retail')->first()?->title ?? 'Retail Service' }}" 
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="4" required>{{ \App\Models\Layanan::where('key', 'service_retail')->first()?->description ?? 'Pengembangan perangkat lunak customisasi adalah proses merancang, membuat, menyebarkan, dan memelihara perangkat lunak yang bertujuan agar dapat digunakan dalam sekumpulan pengguna, fungsi, atau organisasi tertentu.' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-save me-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="serviceCardModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Service Card</h5>
                </div>
                <form id="serviceCardForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="serviceCardId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <div id="imagePreview" class="mt-2 text-center" style="display: none;">
                                <img src="" alt="Preview" style="max-height: 150px;">
                            </div>
                            <label class="form-label">Gambar</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-save me-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteServiceCardModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus service card ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDeleteServiceCard()">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="retailServiceCardModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Retail Service Card</h5>
                </div>
                <form id="retailServiceCardForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="retailServiceCardId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <div id="retailServiceCardImagePreview" class="mt-2 text-center" style="display: none;">
                                <img src="" alt="Preview" style="max-height: 150px;">
                            </div>
                            <label class="form-label">Gambar</label>
                            <input type="file" class="form-control" name="image" id="retailServiceCardImage" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="retailServiceCardTitle" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="retailServiceCardDescription" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-save me-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteRetailServiceModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus retail service ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDeleteRetailService()">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editRetailTitleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Retail Service Title</h5>
                </div>
                <form action="{{ route('layanan.update-retail') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" 
                                   value="{{ \App\Models\Layanan::where('key', 'service_retail')->first()?->title ?? 'Retail Service' }}" 
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="4" required>{{ \App\Models\Layanan::where('key', 'service_retail')->first()?->description ?? 'Deskripsi default' }}</textarea>
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

    <div class="modal fade" id="deleteSelectedConfirmationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus <span id="selectedCount">0</span> logo client yang dipilih?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeDeleteConfirmation()">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn" onclick="deleteSelectedClients()">
                        <i class="bi bi-trash me-2"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="profilekamiModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profil Perusahaan</h5>
                </div>
                <form action="{{ route('profilekami.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="title" 
                                   value="{{ \App\Models\ProfileKami::first()?->title ?? 'Profile Singkat Kami' }}" 
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi 1</label>
                            <textarea class="form-control" 
                                      name="description_1" 
                                      rows="8" 
                                      required>{{ \App\Models\ProfileKami::first()?->description_1 ?? 'Dengan semangat dan potensi anak muda yang mempunyai cita-cita akan mengembangkan Teknologi Informasi yang dapat di jangkau dan berguna bagi masyarakat di semua kalangan, kami memulainya dengan membuat beberapa produk layanan yang berbasis Online Technology, seperti Online Shop, Market Place, Corporate Website, dll.' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi 2</label>
                            <textarea class="form-control" 
                                      name="description_2" 
                                      rows="8" 
                                      required>{{ \App\Models\ProfileKami::first()?->description_2 ?? 'Hingga pada akhirnya kami resmi menggunakan bendera PT Digital Fatih Indonesia (DFI) pada bulan Desember 2015 dan berganti menjadi PT Digital Forte Indonesia pada Febuari 2022. Sesuai Perijinan dan Legalitas yang dibuat, DFI bergerak dalam bidang usaha IT Development baik Software maupun Hardware' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <div class="modal fade" id="visiMisiModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Visi & Misi</h5>
                </div>
                <form id="visiMisiForm" action="{{ route('visimisi.update') }}" method="POST">
                    @csrf 
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Visi</label>
                            <textarea class="form-control" 
                                     name="visi" 
                                     rows="4" 
                                     required>{{ \App\Models\VisiMisi::where('key', 'visi')->first()?->content ?? 'Menjadi perusahaan IT terdepan yang memberikan solusi teknologi inovatif dan terjangkau bagi semua kalangan masyarakat.'}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Misi</label>
                            <textarea class="form-control" 
                                     name="misi" 
                                     rows="4" 
                                     required>{{ \App\Models\VisiMisi::where('key', 'misi')->first()?->content ?? 'Mengembangkan solusi teknologi yang inovatif dan berkualitas tinggi untuk memenuhi kebutuhan klien kami.'}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

    let currentSliderId = null;
    let deleteModal = null;
    let manageModal = null;
    let currentClientId = null;
    let deleteClientModal = null;
    let manageClientModal = null;
    let serviceCardModal;
    let deleteServiceCardModal;
    let currentServiceCardId;
    let retailServiceCardModal;
    let currentRetailServiceCardId = null;
    let deleteRetailServiceCardModal;
    let deleteSelectedModal;
    let isAllSelected = false;
    let isAllSlidersSelected = false;
    let deleteSelectedSlidersModal;
    let selectedClientIds = [];

    document.addEventListener('DOMContentLoaded', function() {
        deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        manageModal = new bootstrap.Modal(document.getElementById('manageSliderModal'));
        
        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (currentSliderId) {
                const form = document.getElementById('delete-form');
                form.action = `/heroslider/${currentSliderId}`;
                
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
                        deleteModal.hide();
                        
                        const sliderElement = document.querySelector(`[data-slider-id="${currentSliderId}"]`);
                        if (sliderElement) {
                            sliderElement.remove();
                        }
                        
                        currentSliderId = null;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
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
                submitButton.innerHTML = '<i class="bi bi-upload me-2"></i>Upload';
                
                if (data.success) {
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
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="bi bi-upload me-2"></i>Upload';
            });
        });
    });

    function deleteSlider(id) {
        currentSliderId = id;
        deleteModal.show();
        document.querySelector('.modal-backdrop:last-child').classList.add('delete-confirmation-backdrop');
    }

    function closeDeleteModal() {
        deleteModal.hide();
    }

    function refreshPage() {
        window.location.reload();
    }

    function handleFileSelect(event, previewId) {
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);
        const type = previewId.replace('Preview', '');
        const closeButton = preview.parentElement.querySelector('.btn-close');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
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
        
        preview.src = type === 'favicon' ? "{{ asset('favicon.png') }}" : "{{ asset('logo.png') }}";
        input.value = '';
        
        if (closeButton) {
            closeButton.style.display = 'none';
        }
        
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
                const faviconLink = document.querySelector('link[rel="icon"]');
                if (faviconLink) {
                    const newPath = data.favicon_removed ? 
                        "{{ asset('favicon.png') }}" : 
                        "{{ asset('storage/') }}/" + (data.favicon_path || faviconLink.href.split('?')[0].split('/').pop());
                    faviconLink.href = newPath + "?v=" + data.timestamp;
                }
                
                const modal = document.getElementById('logoModal');
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                }

                setTimeout(() => {
                    window.location.reload();
                }, 300); 
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

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
                        deleteClientModal.hide();
                        
                        const clientElement = document.querySelector(`[data-client-id="${currentClientId}"]`);
                        if (clientElement) {
                            clientElement.remove();
                        }
                        
                        currentClientId = null;
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
                submitButton.innerHTML = '<i class="bi bi-upload me-2"></i>Upload';
                
                if (data.success) {
                    fetch(window.location.href)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            
                            const clientList = document.querySelector('#manageClientModal .row.g-3');
                            const newClientList = doc.querySelector('#manageClientModal .row.g-3');
                            clientList.innerHTML = newClientList.innerHTML;
                            
                            const clientSlider = document.querySelector('.client-slider');
                            const newClientSlider = doc.querySelector('.client-slider');
                            clientSlider.innerHTML = newClientSlider.innerHTML;
                        });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="bi bi-upload me-2"></i>Upload';
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

    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                navLinks.forEach(l => l.classList.remove('active'));
                
                this.classList.add('active');

                if (window.innerWidth < 992) {
                    setTimeout(() => {
                        const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('mobileSidebar'));
                        if (offcanvas) {
                            offcanvas.hide();
                        }
                    }, 300);
                }
            });
        });
    });

    document.querySelector('#heroContentModal form').addEventListener('submit', function(e) {
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
                const modal = bootstrap.Modal.getInstance(document.getElementById('heroContentModal'));
                modal.hide();
                
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.querySelector('#pageTitlesModal form').addEventListener('submit', function(e) {
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
                const modal = bootstrap.Modal.getInstance(document.getElementById('pageTitlesModal'));
                modal.hide();
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.querySelector('#layananModal form').addEventListener('submit', function(e) {
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
                const modal = bootstrap.Modal.getInstance(document.getElementById('layananModal'));
                modal.hide();
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.querySelector('#retailServiceModal form').addEventListener('submit', function(e) {
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
                const modal = bootstrap.Modal.getInstance(document.getElementById('retailServiceModal'));
                modal.hide();
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        serviceCardModal = new bootstrap.Modal(document.getElementById('serviceCardModal'));
        deleteServiceCardModal = new bootstrap.Modal(document.getElementById('deleteServiceCardModal'));

        const serviceCardForm = document.getElementById('serviceCardForm');
        if (serviceCardForm) {
            serviceCardForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                try {
                    const formData = new FormData(this);
                    const id = formData.get('id');
                    const url = id ? `/service-cards/${id}` : '/service-cards';
                    
                    if (id) {
                        formData.append('_method', 'PUT');
                    }

                    const submitBtn = this.querySelector('button[type="submit"]');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';

                    const response = await fetch(url, {
                        method: 'POST', 
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(Object.values(errorData.errors).flat().join('\n'));
                    }

                    const data = await response.json();
                    
                    if (data.success) {
                        serviceCardModal.hide();
                        window.location.reload();
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan: ' + error.message);
                } finally {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Simpan';
                }
            });
        }

        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const preview = document.getElementById('imagePreview');
                const previewImg = preview.querySelector('img');
                const file = e.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });

    function showAddServiceCardModal() {
        document.getElementById('serviceCardForm').reset();
        document.getElementById('serviceCardId').value = '';
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');
        previewImg.src = ''; 
        preview.style.display = 'none'; 
        serviceCardModal.show();
    }

    function editServiceCard(id, title, description, imageUrl) {
        const button = event.target.closest('button');
        
        document.getElementById('serviceCardForm').reset();
        document.getElementById('serviceCardId').value = id;
        document.getElementById('title').value = title;
        document.getElementById('description').value = description;

        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');
        if (imageUrl) {
            previewImg.src = imageUrl;
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
        
        serviceCardModal.show();
    }

    function deleteServiceCard(id) {
        currentServiceCardId = id;
        deleteServiceCardModal.show();
    }

    function confirmDeleteServiceCard() {
        fetch(`/service-cards/${currentServiceCardId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                deleteServiceCardModal.hide();
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        retailServiceCardModal = new bootstrap.Modal(document.getElementById('retailServiceCardModal'));
        deleteRetailServiceCardModal = new bootstrap.Modal(document.getElementById('deleteRetailServiceModal'));

        const retailServiceCardForm = document.getElementById('retailServiceCardForm');
        if (retailServiceCardForm) {
            retailServiceCardForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                try {
                    const formData = new FormData(this);
                    const id = formData.get('id');
                    const url = id ? `/retail-services/${id}` : '/retail-services';
                    
                    if (id) {
                        formData.append('_method', 'PUT');
                    }

                    const submitBtn = this.querySelector('button[type="submit"]');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';

                    const response = await fetch(url, {
                        method: 'POST', 
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(Object.values(errorData.errors).flat().join('\n'));
                    }

                    const data = await response.json();
                    
                    if (data.success) {
                        retailServiceCardModal.hide();
                        window.location.reload();
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan: ' + error.message);
                } finally {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Simpan';
                }
            });
        }

        const retailServiceCardImage = document.getElementById('retailServiceCardImage');
        if (retailServiceCardImage) {
            retailServiceCardImage.addEventListener('change', function(e) {
                const preview = document.getElementById('retailServiceCardImagePreview');
                const previewImg = preview.querySelector('img');
                const file = e.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });

    function showAddRetailServiceCardModal() {
        document.getElementById('retailServiceCardForm').reset();
        document.getElementById('retailServiceCardId').value = '';
        document.getElementById('retailServiceCardImagePreview').style.display = 'none';
        retailServiceCardModal.show();
    }

    function editRetailServiceCard(id, title, description, imageUrl) {
        if (!retailServiceCardModal) {
            retailServiceCardModal = new bootstrap.Modal(document.getElementById('retailServiceCardModal'));
        }
        
        const form = document.getElementById('retailServiceCardForm');
        form.reset();
        
        document.getElementById('retailServiceCardId').value = id;
        document.getElementById('retailServiceCardTitle').value = decodeURIComponent(title.replace(/\+/g, ' '));
        document.getElementById('retailServiceCardDescription').value = decodeURIComponent(description.replace(/\+/g, ' '));
        
        const preview = document.getElementById('retailServiceCardImagePreview');
        const previewImg = preview.querySelector('img');
        if (imageUrl) {
            previewImg.src = decodeURIComponent(imageUrl.replace(/\+/g, ' '));
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }

        retailServiceCardModal.show();
    }

    function deleteRetailServiceCard(id) {
        currentRetailServiceCardId = id;
        deleteRetailServiceCardModal.show();
    }

    function confirmDeleteRetailService() {
        fetch(`/retail-services/${currentRetailServiceCardId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                deleteRetailServiceCardModal.hide();
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        deleteSelectedModal = new bootstrap.Modal(document.getElementById('deleteSelectedConfirmationModal'));
        
        document.querySelectorAll('.client-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateDeleteSelectedButton();
            });
    });

    const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
    if (deleteSelectedBtn) {
        deleteSelectedBtn.addEventListener('click', function() {
            confirmDeleteSelected();
        });
    }
    });

    function confirmDeleteSelected() {
        const selectedClientIds = Array.from(document.querySelectorAll('.client-checkbox:checked'))
                            .map(checkbox => checkbox.value);
        
        if (selectedClientIds.length === 0) {
            return;
        }

        document.getElementById('selectedCount').textContent = selectedClientIds.length;
        document.getElementById('manageClientModal').classList.add('dim-background');
        deleteSelectedModal.show();
        document.querySelector('.modal-backdrop:last-child').classList.add('delete-confirmation-backdrop');
    }

    function deleteSelectedClients() {
        const selectedClientIds = Array.from(document.querySelectorAll('.client-checkbox:checked'))
                            .map(checkbox => checkbox.value);
        const deleteBtn = document.getElementById('confirmDeleteBtn');
        const originalContent = deleteBtn.innerHTML;
        
        deleteBtn.disabled = true;
        deleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menghapus...';
        
        fetch('/clientslider/delete-multiple', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                ids: selectedClientIds
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                selectedClientIds.forEach(id => {
                    const clientElement = document.querySelector(`[data-client-id="${id}"]`);
                    if (clientElement) {
                        clientElement.remove();
                    }
                });

                selectedClientIds.length = 0;
                isAllSelected = false;
                
                updateDeleteSelectedButton();
                deleteSelectedModal.hide();
                window.location.reload();
            } else {
                throw new Error(data.message || 'Terjadi kesalahan saat menghapus');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data');
        })
        .finally(() => {
            deleteBtn.disabled = false;
            deleteBtn.innerHTML = originalContent;
        });
    }

    function closeDeleteConfirmation() {
        deleteSelectedModal.hide();
        document.getElementById('manageClientModal').classList.remove('dim-background');
        
        const backdrop = document.querySelector('.modal-backdrop.delete-confirmation-backdrop');
        if (backdrop) {
            backdrop.classList.remove('delete-confirmation-backdrop');
        }
    }

    document.getElementById('deleteSelectedConfirmationModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeDeleteConfirmation();
        }
    });

    function deleteSelectedClients() {
        const selectedClientIds = Array.from(document.querySelectorAll('.client-checkbox:checked'))
                                .map(checkbox => checkbox.value);
        
        if (selectedClientIds.length === 0) {
            alert('Pilih minimal satu item untuk dihapus');
            return;
        }

        const deleteBtn = document.getElementById('confirmDeleteBtn');
        const originalContent = deleteBtn.innerHTML;
        
        deleteBtn.disabled = true;
        deleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menghapus...';
        
        fetch('/clientslider/delete-multiple', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                ids: selectedClientIds
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                selectedClientIds.forEach(id => {
                    const clientElement = document.querySelector(`[data-client-id="${id}"]`);
                    if (clientElement) {
                        clientElement.remove();
                    }
                });

                selectedClientIds.length = 0;
                isAllSelected = false;
                
                updateDeleteSelectedButton();
                deleteSelectedModal.hide();
            } else {
                throw new Error(data.message || 'Terjadi kesalahan saat menghapus');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data');
        })
        .finally(() => {
            deleteBtn.disabled = false;
            deleteBtn.innerHTML = originalContent;
        });
    }

    function toggleCheckbox(event, clientId) {
        if (event.target.closest('.btn-warning')) {
            return;
        }
        
        const checkbox = event.currentTarget.querySelector('.client-checkbox');
        const card = event.currentTarget;
        
        checkbox.checked = !checkbox.checked;
        
        if (checkbox.checked) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
        
        updateDeleteSelectedButton();
    }

    function updateDeleteSelectedButton() {
        const selectedCount = document.querySelectorAll('.client-checkbox:checked').length;
        const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
        const selectedItemCount = document.getElementById('selectedItemCount');
        
        if (selectedCount > 0) {
            deleteSelectedBtn.style.display = 'flex';
            selectedItemCount.textContent = selectedCount;
        } else {
            deleteSelectedBtn.style.display = 'none';
            selectedItemCount.textContent = '0'; 
        }
    }

    document.querySelectorAll('.client-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.card');
            if (this.checked) {
                card.classList.add('selected');
            } else {
                card.classList.remove('selected');
            }
            updateDeleteSelectedButton();
        });
    });

    function toggleSelectAll() {
        isAllSelected = !isAllSelected;
        const checkboxes = document.querySelectorAll('.client-checkbox');
        const selectAllBtn = document.getElementById('selectAllBtn');
        
        checkboxes.forEach(checkbox => {
            checkbox.checked = isAllSelected;
            const card = checkbox.closest('.card');
            if (isAllSelected) {
                card.classList.add('selected');
                selectAllBtn.classList.remove('btn-outline-secondary');
                selectAllBtn.classList.add('btn-secondary');
            } else {
                card.classList.remove('selected');
                selectAllBtn.classList.remove('btn-secondary');
                selectAllBtn.classList.add('btn-outline-secondary');
            }
        });
        
        updateDeleteSelectedButton();
    }

    function updateDeleteSelectedButton() {
        const totalCheckboxes = document.querySelectorAll('.client-checkbox').length;
        const selectedCount = document.querySelectorAll('.client-checkbox:checked').length;
        const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
        const selectedItemCount = document.getElementById('selectedItemCount');
        const selectAllBtn = document.getElementById('selectAllBtn');
        
        if (selectedCount > 0) {
            deleteSelectedBtn.style.display = 'flex';
            selectedItemCount.textContent = selectedCount;
            
            if (selectedCount === totalCheckboxes) {
                isAllSelected = true;
                selectAllBtn.classList.remove('btn-outline-secondary');
                selectAllBtn.classList.add('btn-secondary');
            } else {
                isAllSelected = false;
                selectAllBtn.classList.remove('btn-secondary');
                selectAllBtn.classList.add('btn-outline-secondary');
            }
        } else {
            deleteSelectedBtn.style.display = 'none';
            selectedItemCount.textContent = '0';
            
            isAllSelected = false;
            selectAllBtn.classList.remove('btn-secondary');
            selectAllBtn.classList.add('btn-outline-secondary');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        deleteSelectedSlidersModal = new bootstrap.Modal(document.getElementById('deleteSelectedSlidersConfirmationModal'));
    });

    function toggleSliderCheckbox(event, sliderId) {
        if (event.target.closest('.btn-warning')) {
            return;
        }
        
        const checkbox = event.currentTarget.querySelector('.slider-checkbox');
        const card = event.currentTarget;
        
        checkbox.checked = !checkbox.checked;
        
        if (checkbox.checked) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
        
        updateDeleteSelectedSlidersButton();
    }

    function toggleSelectAllSliders() {
        isAllSlidersSelected = !isAllSlidersSelected;
        const checkboxes = document.querySelectorAll('.slider-checkbox');
        const selectAllBtn = document.getElementById('selectAllSliderBtn');
        
        checkboxes.forEach(checkbox => {
            checkbox.checked = isAllSlidersSelected;
            const card = checkbox.closest('.card');
            if (isAllSlidersSelected) {
                card.classList.add('selected');
                selectAllBtn.classList.remove('btn-outline-secondary');
                selectAllBtn.classList.add('btn-secondary');
            } else {
                card.classList.remove('selected');
                selectAllBtn.classList.remove('btn-secondary');
                selectAllBtn.classList.add('btn-outline-secondary');
            }
        });
        
        updateDeleteSelectedSlidersButton();
    }

    function updateDeleteSelectedSlidersButton() {
        const totalCheckboxes = document.querySelectorAll('.slider-checkbox').length;
        const selectedCount = document.querySelectorAll('.slider-checkbox:checked').length;
        const deleteSelectedBtn = document.getElementById('deleteSelectedSlidersBtn');
        const selectedItemCount = document.getElementById('selectedSliderCount');
        const selectAllBtn = document.getElementById('selectAllSliderBtn');
        
        if (selectedCount > 0) {
            deleteSelectedBtn.style.display = 'flex';
            selectedItemCount.textContent = selectedCount;
            
            if (selectedCount === totalCheckboxes) {
                isAllSlidersSelected = true;
                selectAllBtn.classList.remove('btn-outline-secondary');
                selectAllBtn.classList.add('btn-secondary');
            } else {
                isAllSlidersSelected = false;
                selectAllBtn.classList.remove('btn-secondary');
                selectAllBtn.classList.add('btn-outline-secondary');
            }
        } else {
            deleteSelectedBtn.style.display = 'none';
            selectedItemCount.textContent = '0';
            
            isAllSlidersSelected = false;
            selectAllBtn.classList.remove('btn-secondary');
            selectAllBtn.classList.add('btn-outline-secondary');
        }
    }

    function confirmDeleteSelectedSliders() {
        const selectedCount = document.querySelectorAll('.slider-checkbox:checked').length;
        
        if (selectedCount === 0) {
            return;
        }
        
        document.getElementById('selectedSlidersCount').textContent = selectedCount;
        const deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteSelectedSlidersConfirmationModal'));
        deleteConfirmModal.show();
        document.querySelector('.modal-backdrop:last-child').classList.add('delete-selected-sliders-backdrop');
    }

    document.getElementById('deleteSelectedSlidersBtn').onclick = confirmDeleteSelectedSliders;

    function closeDeleteSlidersConfirmation() {
        const deleteConfirmModal = bootstrap.Modal.getInstance(document.getElementById('deleteSelectedSlidersConfirmationModal'));
        deleteConfirmModal.hide();
        const backdrop = document.querySelector('.modal-backdrop.delete-selected-sliders-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
    }

    function deleteSelectedSliders() {
        const selectedIds = Array.from(document.querySelectorAll('.slider-checkbox:checked')).map(cb => cb.value);
        
        fetch('/heroslider/delete-multiple', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ ids: selectedIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeDeleteSlidersConfirmation();
                selectedIds.forEach(id => {
                    const element = document.querySelector(`[data-slider-id="${id}"]`);
                    if (element) {
                        element.remove();
                    }
                });
                
                document.getElementById('selectedSliderCount').textContent = '0';
                document.getElementById('deleteSelectedSlidersBtn').style.display = 'none';
                
                const selectAllBtn = document.getElementById('selectAllSliderBtn');
                selectAllBtn.innerHTML = '<i class="bi bi-check-all"></i><span>Pilih Semua</span>';
                selectAllBtn.classList.remove('btn-danger');
                selectAllBtn.classList.add('btn-outline-secondary');
                
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        
                        const carousel = document.querySelector('#heroCarousel .carousel-inner');
                        const newCarousel = doc.querySelector('#heroCarousel .carousel-inner');
                        if (carousel && newCarousel) {
                            carousel.innerHTML = newCarousel.innerHTML;
                        }
                    });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus slider');
        });
    }

    function handleCheckboxClick(event, checkbox) {
        event.stopPropagation();
        
        const card = checkbox.closest('.card');
        
        if (checkbox.checked) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
        
        updateDeleteSelectedSlidersButton();
    }

    let deletePortfolioModal;
    let portfolioIdToDelete;

    document.addEventListener('DOMContentLoaded', function() {
        deletePortfolioModal = new bootstrap.Modal(document.getElementById('deletePortfolioModal'));
    });

    function confirmDeletePortfolio(id) {
        portfolioIdToDelete = id;
        deletePortfolioModal.show();
    }

    function deletePortfolio() {
        if (!portfolioIdToDelete) return;

        fetch(`/portfolio/${portfolioIdToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const portfolioCard = document.querySelector(`[data-portfolio-id="${portfolioIdToDelete}"]`);
                if (portfolioCard) {
                    portfolioCard.remove();
                }
                
                window.location.reload();
            }
            deletePortfolioModal.hide();
        })
        .catch(error => {
            console.error('Error:', error);
            deletePortfolioModal.hide();
        });
    }

    document.querySelector('#profilekamiModal form').addEventListener('submit', function(e) {
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
                const modal = bootstrap.Modal.getInstance(document.getElementById('profilekamiModal'));
                modal.hide();
                
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('visiMisiForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('visiMisiModal'));
                        modal.hide();
                        
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="bi bi-save me-2"></i>Simpan';
                });
            });
        } && 
    });
    </script>
</body>
</html>
