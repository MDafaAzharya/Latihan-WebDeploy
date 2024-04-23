<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
      $image = Image::paginate(10);
      // dd($image);
      return view('dashboard.profiletwo.foto', compact('image'));
    }
    public function store(Request $request)
    {
      if ($request->file('foto')) {
        // $foto = $this->upload($request->file('foto'), $this->path);
        $file = $request->file('foto');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('public/images', $fileName);
        // $validated['logo'] = $fileName;
      }
      $insert = Image::create([
        'image' => $fileName,
      ]);
      session()->flash('success', 'Data Berhasil Ditambahkan');
      return back();
    }
    public function destroy(string $id)
    {
      $image = Image::findOrFail($id);
        
      if ($image->image) {
      $imagePath = 'public/images/' . $image->image;
      if (Storage::exists($imagePath)) {
          Storage::delete($imagePath);
      }
      }
      $image->delete();
      session()->flash('success', 'Data Berhasil Ditambahkan');
      return back();
    }
}
