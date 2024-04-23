<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mabigus;

class MabigusController extends Controller
{
    public function index()
    {
        $mabigus = Mabigus::all();
        return view('dashboard.profiletwo.mabigus', compact('mabigus'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'text' => 'required'
        ]);

        $data = $request->all();
        $data_update = Mabigus::findOrFail($request->id);
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah Data');
    }

}
