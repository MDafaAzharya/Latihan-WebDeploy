<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mabigus;

class SambutanController extends Controller
{
    public function index()
    {
        $mabigus = Mabigus::all();
        return view("sambutan-magis", compact('mabigus'));
    }
}
