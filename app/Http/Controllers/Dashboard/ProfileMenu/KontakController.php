<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::all();
        return view('dashboard.profiletwo.kontak', compact('kontak'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required',
            'email_to' => 'required',
        ]);

        $data = $request->all();
        $data_update = Kontak::findOrFail($request->id);
        $data_update->email_to = $request->email_to;
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah Data');
    }
}
