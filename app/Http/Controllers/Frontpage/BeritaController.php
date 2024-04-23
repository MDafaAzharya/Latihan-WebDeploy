<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konten;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        $berita = Konten::where('kategori', 'berita')
        ->when($query, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('text', 'like', '%' . $search . '%');
        })
        ->get();
        return view("berita",compact('berita'));
    }
    public function detail($slug)
    {
        $berita =  Konten::where('slug', $slug)->first();
        // dd($berita);
        $news = Konten::where('kategori', 'berita')
        ->orderby('created_at', 'desc')
        ->take(2)
        ->get();
        return view("berita-detail", ['berita' => $berita], compact('news'));
    }

}
