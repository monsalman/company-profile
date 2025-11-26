<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HeroSliderController;
use App\Http\Controllers\ClientSliderController;
use App\Http\Controllers\HeroContentController;
use App\Http\Controllers\ServiceCardController;
use App\Http\Controllers\RetailServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PageTitleController;
use App\Http\Controllers\ProfileKamiController;
use App\Http\Controllers\VisiMisiController;
use App\Models\HeroImage;
use App\Models\ClientSlider;
use App\Models\HeroContent;
use App\Models\ServiceCard;
use App\Models\RetailService;
use App\Models\Portfolio;
use App\Models\Layanan;
use App\Models\PageTitle;
use App\Models\ProfileKami;
use App\Models\VisiMisi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Berikut adalah endpoint API untuk mengambil data dari aplikasi.
| Semua endpoint mengembalikan data dalam format JSON.
|
*/

// Test endpoint - untuk memastikan API berjalan
Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'API berjalan dengan baik!',
        'timestamp' => now()->toDateTimeString()
    ]);
});

// Homepage - Mengambil semua data untuk homepage
Route::get('/homepage', function () {
    $sliderImages = HeroImage::orderBy('created_at', 'desc')->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'image' => asset('storage/' . $item->image),
            'order' => $item->order,
            'is_active' => $item->is_active,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
    
    $clientSliders = ClientSlider::orderBy('order')->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'image' => asset('storage/' . $item->image),
            'order' => $item->order,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
    
    $serviceCards = ServiceCard::orderBy('created_at', 'asc')->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'image' => asset('storage/' . $item->image),
            'title' => $item->title,
            'description' => $item->description,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
    
    $retailServices = RetailService::orderBy('created_at', 'asc')->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'image' => asset('storage/' . $item->image),
            'title' => $item->title,
            'description' => $item->description,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
    
    $portfolios = Portfolio::latest()->take(6)->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'description' => $item->description,
            'image' => asset('storage/' . $item->image),
            'slug' => $item->slug,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
    
    $heroContent = HeroContent::first();
    
    return response()->json([
        'success' => true,
        'data' => [
            'hero_sliders' => $sliderImages,
            'client_sliders' => $clientSliders,
            'service_cards' => $serviceCards,
            'retail_services' => $retailServices,
            'portfolios' => $portfolios,
            'hero_content' => $heroContent ? [
                'title' => $heroContent->title,
                'description' => $heroContent->description,
            ] : null,
        ]
    ]);
});

// Hero Sliders
Route::get('/hero-sliders', function () {
    $sliders = HeroImage::orderBy('created_at', 'desc')->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'image' => asset('storage/' . $item->image),
            'order' => $item->order,
            'is_active' => $item->is_active,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
    
    return response()->json([
        'success' => true,
        'data' => $sliders
    ]);
});

Route::get('/hero-sliders/{id}', function ($id) {
    $slider = HeroImage::find($id);
    
    if (!$slider) {
        return response()->json([
            'success' => false,
            'message' => 'Hero slider tidak ditemukan'
        ], 404);
    }
    
    return response()->json([
        'success' => true,
        'data' => [
            'id' => $slider->id,
            'image' => asset('storage/' . $slider->image),
            'order' => $slider->order,
            'is_active' => $slider->is_active,
            'created_at' => $slider->created_at,
            'updated_at' => $slider->updated_at,
        ]
    ]);
});

// Client Sliders
Route::get('/client-sliders', function () {
    $clients = ClientSlider::orderBy('order')->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'image' => asset('storage/' . $item->image),
            'order' => $item->order,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
    
    return response()->json([
        'success' => true,
        'data' => $clients
    ]);
});

Route::get('/client-sliders/{id}', function ($id) {
    $client = ClientSlider::find($id);
    
    if (!$client) {
        return response()->json([
            'success' => false,
            'message' => 'Client slider tidak ditemukan'
        ], 404);
    }
    
    return response()->json([
        'success' => true,
        'data' => [
            'id' => $client->id,
            'image' => asset('storage/' . $client->image),
            'order' => $client->order,
            'created_at' => $client->created_at,
            'updated_at' => $client->updated_at,
        ]
    ]);
});

// Hero Content
Route::get('/hero-content', function () {
    $content = HeroContent::first();
    
    return response()->json([
        'success' => true,
        'data' => $content ? [
            'title' => $content->title,
            'description' => $content->description,
        ] : null
    ]);
});

// Service Cards
Route::get('/service-cards', function () {
    $cards = ServiceCard::orderBy('created_at', 'asc')->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'image' => asset('storage/' . $item->image),
            'title' => $item->title,
            'description' => $item->description,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
    
    return response()->json([
        'success' => true,
        'data' => $cards
    ]);
});

Route::get('/service-cards/{id}', function ($id) {
    $card = ServiceCard::find($id);
    
    if (!$card) {
        return response()->json([
            'success' => false,
            'message' => 'Service card tidak ditemukan'
        ], 404);
    }
    
    return response()->json([
        'success' => true,
        'data' => [
            'id' => $card->id,
            'image' => asset('storage/' . $card->image),
            'title' => $card->title,
            'description' => $card->description,
            'created_at' => $card->created_at,
            'updated_at' => $card->updated_at,
        ]
    ]);
});

// Retail Services
Route::get('/retail-services', function () {
    $services = RetailService::orderBy('created_at', 'asc')->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'image' => asset('storage/' . $item->image),
            'title' => $item->title,
            'description' => $item->description,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
    
    return response()->json([
        'success' => true,
        'data' => $services
    ]);
});

Route::get('/retail-services/{id}', function ($id) {
    $service = RetailService::find($id);
    
    if (!$service) {
        return response()->json([
            'success' => false,
            'message' => 'Retail service tidak ditemukan'
        ], 404);
    }
    
    return response()->json([
        'success' => true,
        'data' => [
            'id' => $service->id,
            'image' => asset('storage/' . $service->image),
            'title' => $service->title,
            'description' => $service->description,
            'created_at' => $service->created_at,
            'updated_at' => $service->updated_at,
        ]
    ]);
});

// Portfolios
Route::get('/portfolios', function () {
    $portfolios = Portfolio::latest()->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'description' => $item->description,
            'image' => asset('storage/' . $item->image),
            'slug' => $item->slug,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
    
    return response()->json([
        'success' => true,
        'data' => $portfolios
    ]);
});

Route::get('/portfolios/{slug}', function ($slug) {
    $portfolio = Portfolio::where('slug', $slug)->first();
    
    if (!$portfolio) {
        return response()->json([
            'success' => false,
            'message' => 'Portfolio tidak ditemukan'
        ], 404);
    }
    
    return response()->json([
        'success' => true,
        'data' => [
            'id' => $portfolio->id,
            'title' => $portfolio->title,
            'description' => $portfolio->description,
            'image' => asset('storage/' . $portfolio->image),
            'slug' => $portfolio->slug,
            'created_at' => $portfolio->created_at,
            'updated_at' => $portfolio->updated_at,
        ]
    ]);
});

// Layanan
Route::get('/layanan', function () {
    $layanan = Layanan::all()->map(function ($item) {
        return [
            'key' => $item->key,
            'title' => $item->title,
            'description' => $item->description,
        ];
    });
    
    return response()->json([
        'success' => true,
        'data' => $layanan
    ]);
});

Route::get('/layanan/{key}', function ($key) {
    $layanan = Layanan::where('key', $key)->first();
    
    if (!$layanan) {
        return response()->json([
            'success' => false,
            'message' => 'Layanan tidak ditemukan'
        ], 404);
    }
    
    return response()->json([
        'success' => true,
        'data' => [
            'key' => $layanan->key,
            'title' => $layanan->title,
            'description' => $layanan->description,
        ]
    ]);
});

// Page Titles
Route::get('/page-titles', function () {
    $titles = PageTitle::all()->map(function ($item) {
        return [
            'key' => $item->key,
            'value' => $item->value,
        ];
    });
    
    return response()->json([
        'success' => true,
        'data' => $titles
    ]);
});

Route::get('/page-titles/{key}', function ($key) {
    $title = PageTitle::where('key', $key)->first();
    
    if (!$title) {
        return response()->json([
            'success' => false,
            'message' => 'Page title tidak ditemukan'
        ], 404);
    }
    
    return response()->json([
        'success' => true,
        'data' => [
            'key' => $title->key,
            'value' => $title->value,
        ]
    ]);
});

// Profile Kami
Route::get('/profile-kami', function () {
    $profile = ProfileKami::first();
    
    return response()->json([
        'success' => true,
        'data' => $profile ? [
            'title' => $profile->title,
            'description_1' => $profile->description_1,
            'description_2' => $profile->description_2,
        ] : null
    ]);
});

// Visi Misi
Route::get('/visi-misi', function () {
    $visi = VisiMisi::where('key', 'visi')->first();
    $misi = VisiMisi::where('key', 'misi')->first();
    
    return response()->json([
        'success' => true,
        'data' => [
            'visi' => $visi ? $visi->content : null,
            'misi' => $misi ? $misi->content : null,
        ]
    ]);
});

