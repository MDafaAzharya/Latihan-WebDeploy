<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::all();
        return view('dashboard.profiletwo.profile', compact('profile'));
    }
    public function update(Request $request)
    {
       //dd($request->all());
        $request->validate([
            'judul' => 'required',
            'text' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data = Profile::find($request->id);
    
        // Cek apakah ada file gambar baru diunggah
        if ($request->hasFile('gambar')) {
            $originalFileName = $request->file('gambar')->getClientOriginalName();
    
            // Menghapus gambar sebelumnya jika ada
            if ($data->image) {
                Storage::delete('public/images/' . $data->image);
            }
    
            // Menyimpan gambar baru ke storage
            $image = $request->file('gambar')->storeAs('public/images', $originalFileName);
    
            // Mengupdate nama file gambar
            $data->image = $originalFileName;
        }
    
        $data->title = $request->judul;
        $data->text = $request->text;
        $data->save();
        return back()->with('success', 'Berhasil mengubah Data');
    }
}
