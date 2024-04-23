<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

class FotoController extends Controller
{
    public function index()
    {
        $foto = Image::all();
        return view("galeri-foto",compact('foto'));
    }
}
