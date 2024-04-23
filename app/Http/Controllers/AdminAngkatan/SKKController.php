<?php

namespace App\Http\Controllers\AdminAngkatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSKK;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SKKController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $angkatan = $user->angkatan;
        $penguji = User::where('angkatan', $angkatan)->get();
        
        return view("dashboard-admin-angkatan.skk", compact('penguji'));
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'username' => 'required',
            'tingkat'=> 'required',
            'kategori'=> 'required',
            'penguji'=> 'required',
        ]);
        $data = $request->all();
        $data_update = PengajuanSKK::findOrFail($request->id);
        $data_update->penguji = $request->penguji;
        $data_update->nama_lengkap = $request->username;
        $data_update->tingkat = $request->tingkat;
        $data_update->kategori = $request->kategori;
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah data');

    }

    public function edit(string $id)
    {
        $data = PengajuanSKK::with('nama_kategori','nama_tingkat','nama_pengaju')->find($id);
        //dd($data);
        $responseData = [
            'id' => $data->id,
            'nama_lengkap' => $data->nama_pengaju->nama,
            'nama' => $data->nama_lengkap,
            'tingkat' => $data->tingkat,
            'tingkat_palsu' => $data->nama_tingkat->nama_tingkat,
            'kategori' => $data->kategori,
            'kategori_palsu' => $data->nama_kategori->nama_kategori,
            // tambahkan kolom-kolom lain sesuai kebutuhan
        ];
        return response()->json($responseData);
    }
    public function datatable(){
        $user = Auth::user();
        $query = PengajuanSKK::with('nama_pengaju', 'nama_tingkat', 'nama_kategori', 'nama_penguji')
            ->where('angkatan', '=', $user->angkatan + 1) // Hanya ambil tingkat yang lebih kecil
            ->get();
        return datatables()->of($query)
        ->addIndexColumn()
        ->addColumn('pengaju', function($row){
            return $row->nama_pengaju->nama;
        })
        ->addColumn('tingkat', function($row){
            return $row->nama_tingkat->nama_tingkat;
        })
        ->addColumn('angkatan', function($row){
            return $row->angkatan;
        })
        ->addColumn('kategori', function($row){
            return $row->nama_kategori->nama_kategori;
        })
        ->addColumn('penguji', function($row){
            return $row->nama_penguji ? $row->nama_penguji->nama : 'Belum Dipilih';
        })
        ->addColumn('action', function($item){
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\">Pilih Penguji</button>";
            return $button_edit;
          })
        ->rawColumns(['action'])
        ->make(true);
    }
}
