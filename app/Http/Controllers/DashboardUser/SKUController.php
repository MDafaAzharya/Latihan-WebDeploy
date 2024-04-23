<?php

namespace App\Http\Controllers\DashboardUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSKU;
use App\Models\JawabanSKU;
use App\Models\SoalSKU;
use App\Models\User;
use App\Models\Tingkat;
use Illuminate\Support\Facades\Auth;


class SKUController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tingkatUser = $user->tingkat; 
        $userid = $user->id;
        $angkatan = $user->angkatan;
        $pengajuan = Tingkat::all();
        $tingkat = Tingkat::all();
        $namauser = User::where('id', $userid)->get();
        return view("dashboard-user.sku", compact('pengajuan', 'namauser','tingkat','angkatan'));
    }
    public function store(Request $request)
    {
         //dd($request->all());
         $request->validate([
            'id' => 'required',
            'tingkat' => 'required',
            'angkatan' => 'required',
          ]);
          $data = $request->all();
          $data['status'] = $request->input('status');
          $data['angkatan'] = $request->input('angkatan');
          $data['nama_lengkap'] = $request->input('id');
          $data['tingkat'] = $request->input('tingkat');
          $insert = PengajuanSKU::create($data);
  
          return back()->with('success', 'Berhasil menambahkan Data');
    }

    public function datatable(){
        $user = Auth::user();
        $userid = $user->id;
        $query = PengajuanSKU::with('nama_tingkat','nama_pengaju','nama_sertifikat')
        ->where('nama_lengkap', $userid)
        ->get();
        return datatables()->of($query)
        ->addIndexColumn()
        ->addColumn('nama', function($row){
            return $row->nama_pengaju->nama;
        })
        ->addColumn('tingkat', function($row){
            return $row->nama_tingkat->nama_tingkat;
        })
        ->addColumn('detail', function ($row) {
            $button_edit = '';
            if ($row->status === 'Lulus') {
            $button_edit = "
            <a href=\"" . route('detail-user-edit', ['id' => $row->id]) . "\" class=\"ms-auto text-white btn btn-primary ms-auto text-danger\">Lihat Hasil</a>
           ";
            }
            return $button_edit;
        })
        ->addColumn('action', function ($row) {
            $button_edit = '';
            if ($row->status === 'Lulus') {
                $button_edit = "
                    <a href=\"" . asset('sertifikat/' . $row->nama_sertifikat->nama_serti) . "\" class=\"ms-auto text-white btn btn-primary ms-auto text-danger\" download>Download Sertifikat</a>
                  ";
            }
            return $button_edit;
        })
        ->rawColumns(['action','detail'])
        ->make(true);
    }

    public function detail($id)
    {
        $pengajuanCollection = JawabanSKU::where('pengajuan', $id)->get();
        $pengajuanFirst = JawabanSKU::where('pengajuan', $id)->first();

        $aju = $pengajuanFirst->pengaju;
        $pengaju = User::where('id',$aju)->get();
        $uji = $pengajuanFirst->penguji;
        $penguji = User::where('id',$uji)->get();
    
        $pengajuanArray = $pengajuanCollection->toArray();
        $soal = [];
        $tanggal = [];
    
        foreach ($pengajuanCollection as $pengajuan) {
    
            $question = $pengajuan->soal;
            $soal[] = SoalSKU::where('id', $question)->first();

            $tanggal[] = $pengajuan->created_at;
        }
    
        return view('dashboard-user.detail',compact('pengaju','penguji','soal','tanggal'));
    }
}
