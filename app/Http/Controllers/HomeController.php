<?php

namespace App\Http\Controllers;

use App\Models\HeroImage;
use App\Models\ClientSlider;
use App\Models\ServiceCard;
use App\Models\RetailService;

class HomeController extends Controller
{
    public function index()
    {
        $sliderImages = HeroImage::orderBy('created_at', 'desc')->get();
        $clientSliders = ClientSlider::orderBy('order')->get();
        $serviceCards = ServiceCard::orderBy('created_at', 'asc')->get();
        $retailServices = RetailService::orderBy('created_at', 'asc')->get();
            
        return view('homepage', compact('sliderImages', 'clientSliders', 'serviceCards', 'retailServices'));
    }
} 