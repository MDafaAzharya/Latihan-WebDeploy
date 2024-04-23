<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;


class VideoController extends Controller
{
    public function index()
    {
      $video = Video::all();
      // dd($video);
      return view('dashboard.profiletwo.video', compact('video'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required'
        ]);
        $data = $request->all();
        $insert = Video::create($data);
        return back()->with('success', 'Berhasil menambah Video');
    }
    public function destroy(string $id)
    {
      $video = Video::findOrFail($id);
        
      $video->delete();
      session()->flash('success', 'Data Berhasil Dihapus');
      return back();
    }
}
