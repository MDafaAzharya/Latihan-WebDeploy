<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proker;

class ProgramkerjaController extends Controller
{
    public function index()
    {
        $proker = Proker::all();
        return view("program-kerja",compact('proker'));
    }
}
