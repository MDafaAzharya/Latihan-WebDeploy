<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proker;

class ProkerController extends Controller
{
    public function index()
    {
        $proker = Proker::all();
        return view('dashboard.profiletwo.proker', compact('proker'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'text' => 'required'
        ]);

        $data = $request->all();
        $data_update = Proker::findOrFail($request->id);
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah Data');
    }
}
