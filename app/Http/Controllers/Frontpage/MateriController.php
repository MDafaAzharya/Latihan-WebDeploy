<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konten;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        $materi = Konten::where('kategori', 'materi')
        ->when($query, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('text', 'like', '%' . $search . '%');
        })
        ->get();
        return view("materi",compact('materi'));
    }
    public function detail($id)
    {
        $materi =  Konten::find($id);
        $lesson = Konten::where('kategori', 'materi')
        ->orderby('created_at', 'desc')
        ->take(2)
        ->get();
        return view("materi-detail", ['materi' => $materi], compact('lesson'));
    }
}
