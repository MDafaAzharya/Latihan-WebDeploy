<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konten;
use App\Models\Carousel;
use App\Models\Prestasi;
use App\Models\FAQ;
use App\Models\Profile;

class HomeController extends Controller
{
    public function home()
    {
        $berita = Konten::where('kategori', 'berita')
                        ->orderby('created_at', 'desc')
                        ->take(6)
                        ->get();
        $carousel = Carousel::all();
        $prestasi = Prestasi::orderby('created_at', 'desc')
                        ->take(6)
                        ->get();
        $faq = FAQ::orderby('created_at', 'desc')->get();
        $profile = Profile::all();
        return view("home", compact('berita','carousel','prestasi','faq','profile'));
    }
}
