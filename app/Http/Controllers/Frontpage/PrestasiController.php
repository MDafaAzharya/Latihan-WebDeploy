<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prestasi;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::all();
        return view("prestasi",compact('prestasi'));
    }
    public function detail($id)
    {
        $prestasi = Prestasi::find($id);
        $reward = Prestasi::orderby('created_at', 'desc')
        ->take(2)
        ->get();
        return view("prestasi-detail", ['prestasi' => $prestasi],compact('reward'));
    }

}
