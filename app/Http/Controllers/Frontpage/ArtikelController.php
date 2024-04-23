<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konten;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        $artikel = Konten::where('kategori', 'artikel')
        ->when($query, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('text', 'like', '%' . $search . '%');
        })
        ->get();
        return view("artikel",compact('artikel'));
    }
    public function detail($slug)
    {
        $artikel =  Konten::where('slug', $slug)->first();
        $articel = Konten::where('kategori', 'artikel')
        ->orderby('created_at', 'desc')
        ->take(2)
        ->get();
        return view("artikel-detail", ['artikel' => $artikel], compact('articel'));
    }
}
