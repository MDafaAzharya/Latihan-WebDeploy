<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'user')->get();
        return view("dashboard.profiletwo.user",compact('user'));
    }

    public function edit(string $id)
    {
       $data =  User::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'nullable|min:8',
        ]);
        $data_update = User::findOrFail($request->id);
        $data_update->email = $request->email;


        if ($request->filled('password')) {
            $data_update->password = Hash::make($request->password);
        }

        $data_update->save();

        return back()->with('success', 'Berhasil mengubah data');

    }

    public function destroy(string $id)
    {
      $user = User::findOrFail($id);
        
      $user->delete();
      session()->flash('success', 'Data Berhasil Dihapus');
      return back();
    }

    public function promosi($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update(['role' => 'admin_angkatan']);
            return back()->with('success', 'Pengguna berhasil dipromosikan.');
        } else {
            return back()->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    public function down($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update(['role' => 'user']);
            return back()->with('success', 'Pengguna berhasil diturunkan.');
        } else {
            return back()->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    public function datatable(){
        $query = User::with('nama_tingkat')->get();
        return datatables()->of($query)
        ->addIndexColumn()
        ->addColumn('username', function($row){
            return $row->nama;
        })
        ->addColumn('email', function($row){
            return $row->email;
        })
        ->addColumn('tingkat', function($row){
            return $row->nama_tingkat ? $row->nama_tingkat->nama_tingkat : 'Admin';
        })
        ->addColumn('role', function($row){
            return $row->role;
        })
        ->addColumn('action', function($item){
            $button_promosi = "<button class=\"btn btn-primary p-2 mx-1 btn-promosi\" data-id=\"" . $item->id . "\" data-username=\"" . $item->nama . "\">";
            $button_delete = "<button class=\"btn btn-danger p-2 mx-1 btn-delete\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-trash\"></i></button>";
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-pencil\"></i></button>";
            
            // Mengubah tampilan tombol berdasarkan role
            $button_promosi .= $item->role === 'admin_angkatan' ? 'Turunkan Jabatan' : 'Promosikan';
            
            $button_promosi .= "</button>";
            return $button_promosi . $button_delete . $button_edit;
          })
        ->rawColumns(['action'])
        ->make(true);
    }

}
