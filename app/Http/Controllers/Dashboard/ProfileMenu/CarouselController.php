<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
      $image = Carousel::paginate(10);
      // dd($image);
      return view('dashboard.profiletwo.carousel', compact('image'));
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
      $insert = Carousel::create([
        'image' => $fileName,
      ]);
      session()->flash('success', 'Data Berhasil Ditambahkan');
      return back();
    }
    public function destroy(string $id)
    {
      $image = Carousel::findOrFail($id);
        
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
