<?php

namespace App\Http\Controllers\AdminAngkatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSKU;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SKUController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $angkatan = $user->angkatan;
        $penguji = User::where('angkatan', $angkatan)->get();
        return view("dashboard-admin-angkatan.sku", compact('penguji'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required',
            'tingkat'=> 'required',
            'penguji'=> 'required',
        ]);
        $data = $request->all();
        $data_update = PengajuanSKU::findOrFail($request->id);
        $data_update->penguji = $request->penguji;
        $data_update->nama_lengkap = $request->username;
        $data_update->tingkat = $request->tingkat;
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah data');

    }

    public function edit(string $id)
    {
      // dd($request->all());
        $data = PengajuanSKU::with('nama_tingkat','nama_pengaju')->find($id);
        // dd($data);
        $penguji = User::where('tingkat' ,$data->tingkat + 1)->where('id', '!=', Auth::id())->get();
        // dd($penguji);
        $responseData = [
            'id' => $data->id,
            'nama_lengkap' => $data->nama_pengaju->nama,
            'nama' => $data->nama_lengkap,
            'tingkat' => $data->tingkat,
            'tingkat_palsu' => $data->nama_tingkat->nama_tingkat,
            'penguji' => $penguji,
            // tambahkan kolom-kolom lain sesuai kebutuhan
        ];
        return response()->json($responseData);
    }
    public function datatable(){
        $user = Auth::user();
        $query = PengajuanSKU::with('nama_pengaju', 'nama_tingkat', 'nama_penguji')
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
