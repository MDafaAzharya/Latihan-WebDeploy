<?php

namespace App\Http\Controllers\AdminAngkatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'user')->get();
        return view("dashboard-admin-angkatan.user",compact('user'));
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

    public function datatable(){
        $user = Auth::user();
        $tingkat = $user->tingkat;
        $query = User::where('tingkat',$tingkat)->with('nama_tingkat')->get();
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
            $button_delete = "<button class=\"btn btn-danger p-2 mx-1 btn-delete\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-trash\"></i></button>";
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-pencil\"></i></button>";
            
            return $button_delete . $button_edit;
          })
        ->rawColumns(['action'])
        ->make(true);
    }
}
