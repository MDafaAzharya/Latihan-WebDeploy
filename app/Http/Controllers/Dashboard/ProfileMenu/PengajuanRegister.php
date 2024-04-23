<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use App\Models\RegisterPengajuan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class PengajuanRegister extends Controller
{
    public function index()
    {
        return view('dashboard.profiletwo.pengajuan-register');
    }

    public function datatable(){
        $query = RegisterPengajuan::all();
        return datatables()->of($query)
        ->addIndexColumn()
        ->addColumn('username', function($row){
            return $row->nama;
        })
        ->addColumn('email', function($row){
            return $row->email;
        })
        ->addColumn('action', function($item){
           
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\">Approve</button>";
       
            return $button_edit;
          })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function approve($id)
    {
        $pengajuan = RegisterPengajuan::findOrFail($id);

        // Create a new user using the pengajuan data
        User::create([
            'nama' => $pengajuan->nama,
            'email' => $pengajuan->email,
            'angkatan' => $pengajuan->angkatan,
            'nomor' => $pengajuan->nomor,
            'role' => $pengajuan->role,
            'tingkat' => $pengajuan->tingkat,
            'tingkat_skk' => $pengajuan->tingkat_skk,
            'password' => Hash::make($pengajuan['password']),
            // Add other fields as needed
        ]);
    
        // Delete the approved entry from the pengajuan table
        $pengajuan->delete();
        return back()->with('success', 'Berhasil Mendaftarkan User');
    
    }
}
