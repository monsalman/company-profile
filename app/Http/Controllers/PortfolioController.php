<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('portfolio', compact('portfolios'));
    }

    public function create()
    {
        return view('formportofolio');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->file('image')->store('portfolios', 'public');
        
        Portfolio::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath
        ]);

        return redirect()->route('home')
                        ->with('success', 'Portfolio berhasil ditambahkan');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('formportofolio', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $data = [
                'title' => $validated['title'],
                'description' => $validated['description'],
            ];

            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($portfolio->image) {
                    Storage::disk('public')->delete($portfolio->image);
                }
                $imagePath = $request->file('image')->store('portfolios', 'public');
                $data['image'] = $imagePath;
            }

            $portfolio->update($data);

            return redirect()->route('home')
                            ->with('success', 'Portfolio berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan saat memperbarui portfolio')
                            ->withInput();
        }
    }

    public function destroy(Portfolio $portfolio)
    {
        try {
            $portfolio->deleteImage();
            $portfolio->delete();

            return response()->json([
                'success' => true,
                'message' => 'Portfolio berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus portfolio'
            ], 500);
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('portfolio-content', $fileName, 'public');
            
            $url = '/storage/' . $filePath;
            
            return response()->json([
                'url' => $url
            ]);
        }
        
        return response()->json([
            'error' => [
                'message' => 'Tidak ada file yang diupload'
            ]
        ], 400);
    }

    public function show(Portfolio $portfolio)
    {
        return view('portfolio-detail', compact('portfolio'));
    }
}
