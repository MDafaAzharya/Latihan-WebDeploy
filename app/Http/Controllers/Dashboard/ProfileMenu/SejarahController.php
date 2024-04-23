<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sejarah;


class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = Sejarah::all();
        return view('dashboard.profiletwo.sejarah', compact('sejarah'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'text' => 'required'
        ]);

        $data = $request->all();
        $data_update = Sejarah::findOrFail($request->id);
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah Data');
    }

}
