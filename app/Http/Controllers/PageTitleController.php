<?php

namespace App\Http\Controllers;

use App\Models\PageTitle;
use Illuminate\Http\Request;

class PageTitleController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'homepage_title' => 'required|string|max:255',
            'login_title' => 'required|string|max:255',
            'error_404_title' => 'required|string|max:255',
        ]);

        // Update atau create untuk setiap title
        PageTitle::updateOrCreate(
            ['key' => 'homepage'],
            ['value' => $request->homepage_title]
        );

        PageTitle::updateOrCreate(
            ['key' => 'login'],
            ['value' => $request->login_title]
        );

        PageTitle::updateOrCreate(
            ['key' => 'error_404'],
            ['value' => $request->error_404_title]
        );

        return response()->json(['success' => true]);
    }
} 