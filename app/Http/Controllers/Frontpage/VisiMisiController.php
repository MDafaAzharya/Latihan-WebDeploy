<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visimisi;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visimisi = VisiMisi::all();
        return view("visi-misi", compact('visimisi'));
    }
}
