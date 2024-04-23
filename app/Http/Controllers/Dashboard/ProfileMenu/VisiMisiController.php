<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visimisi;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visimisi = Visimisi::all();
        return view('dashboard.profiletwo.visimisi', compact('visimisi'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'text' => 'required'
        ]);

        $data = $request->all();
        $data_update = Visimisi::findOrFail($request->id);
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah Data');
    }
}
