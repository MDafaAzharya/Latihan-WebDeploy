<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriDokumen;


class DokumenController extends Controller
{
    public function index()
    {
        $dokumen = KategoriDokumen::with('dokumen')->get();
        return view("dokumen", compact('dokumen'));
    }
}
