<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kepengurusan;

class KepengurusanController extends Controller
{
    public function index()
    {
        $kepengurusan = Kepengurusan::all();
        return view("kepengurusan", compact('kepengurusan'));
    }
}
