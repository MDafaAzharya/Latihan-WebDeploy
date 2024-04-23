<?php

namespace App\Http\Controllers\DashboardUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSKU;
use App\Models\User;
use App\Models\Tingkat;
use Illuminate\Support\Facades\Auth;

class DaftarSKUController extends Controller
{
    public function index()
    {
        return view("dashboard-user.daftarsku");
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama' => 'required',
            'tingkat' => 'required',
            'tanggal' => 'required',
        ]);
        $data = $request->all();
        $data_update = PengajuanSKU::findOrFail($request->id);
        $data_update->tanggal_pengajuan = $request->tanggal;
        $data_update->nama_lengkap = $request->nama;
        $data_update->tingkat = $request->tingkat;
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah data');

    }

    public function edit(string $id)
    {
        $data = PengajuanSKU::with('nama_tingkat')->find($id);
        
        $responseData = [
            'id' => $data->id,
            'nama_lengkap' => $data->nama_pengaju->nama,
            'nama' => $data->nama_lengkap,
            'tingkat' => $data->tingkat,
            'tingkat_palsu' => $data->nama_tingkat->nama_tingkat,
            // tambahkan kolom-kolom lain sesuai kebutuhan
        ];
    
        return response()->json($responseData);
    }
    public function datatable(){
        $user = Auth::user();
        $userid = $user->id;
        $query = PengajuanSKU::with('nama_tingkat','nama_pengaju')
        ->where('penguji', $userid)
        ->get();
        return datatables()->of($query)
        ->addIndexColumn()
        ->addColumn('pengaju', function($row){
            return $row->nama_pengaju->nama;
        })
        ->addColumn('tingkat', function($row){
            return $row->nama_tingkat->nama_tingkat;
        })
        ->addColumn('tanggal', function($row){
            return $row->tanggal_pengajuan;
        })
        ->addColumn('action', function($item){
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\">Tanggal</button>";
            $button_test = "<button class=\"btn btn-danger p-2 mx-1 btn-test\" data-id=\"" . $item->id . "\" onclick=\"window.location.href='" . route('soal-sku-user', ['id' => $item->id]) . "'\">Test</button>";
            return $button_edit . $button_test;
          })
        ->rawColumns(['action'])
        ->make(true);
    }
}
