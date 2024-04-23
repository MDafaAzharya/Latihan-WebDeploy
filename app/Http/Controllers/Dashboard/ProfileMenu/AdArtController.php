<?php


namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adart;

class AdArtController extends Controller
{
    public function index()
    {
        $adart = Adart::all();
        return view('dashboard.profiletwo.adart', compact('adart'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'text' => 'required'
        ]);

        $data = $request->all();
        $data_update = Adart::findOrFail($request->id);
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah Data');
    }
}
