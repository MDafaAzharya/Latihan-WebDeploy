<?php
namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kepengurusan;

class KepengurusanController extends Controller
{
    public function index()
    {
        $kepengurusan = Kepengurusan::all();
        return view('dashboard.profiletwo.kepengurusan', compact('kepengurusan'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'text' => 'required'
        ]);

        $data = $request->all();
        $data_update = Kepengurusan::findOrFail($request->id);
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah Data');
    }
}
