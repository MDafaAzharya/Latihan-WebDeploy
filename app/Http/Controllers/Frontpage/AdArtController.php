<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adart;

class AdArtController extends Controller
{
    public function index()
    {
        $adArt = AdArt::all();
        return view("ad-art", compact("adArt"));
    }
}
