<?php

namespace App\Http\Controllers\DashboardUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoalSKK;
use App\Models\User;
use App\Models\TingkatSKK;
use App\Models\PengajuanSKK;
use App\Models\JawabanSKK;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\KategoriSKK;
use App\Models\DataSKK;

class SKKController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tingkatUser = $user->tingkat; 
        $userid = $user->id;
        $pengajuan = TingkatSKK::all();
        $tingkat = TingkatSKK::all();
        $kategori = KategoriSKK::all();
        $namauser = User::where('id', $userid)->get();
        $angkatan = $user->angkatan;
        return view("dashboard-user.skk", compact('pengajuan', 'namauser','kategori','tingkat','angkatan'));
    }
    public function store(Request $request)
    {
         //dd($request->all());
         $request->validate([
            'id' => 'required',
            'kategori' => 'required',
            'tingkat' => 'required',
            'angkatan' => 'required',
          ]);
          $data = $request->all();
          $data['nama_lengkap'] = $request->input('id');
          $data['status'] = $request->input('status');
          $data['angkatan'] = $request->input('angkatan');
          $data['tingkat'] = $request->input('tingkat');
          $data['kategori'] = $request->input('kategori');
          $insert = PengajuanSKK::create($data);

          $create = $request->all();
          $create['id_user'] = $request->input('id');
          $create['tingkat'] = $request->input('tingkat');
          $create['kategori'] = $request->input('kategori');
          $kirim = DataSKK::create($create);
  
          return back()->with('success', 'Berhasil menambahkan Data');
    }

    public function datatable(){
        $user = Auth::user();
        $userid = $user->id;
        $query = PengajuanSKK::with('nama_kategori','nama_tingkat','nama_pengaju','nama_sertifikat')
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
        ->addColumn('kategori', function($row){
            return $row->nama_kategori->nama_kategori;
        })
        ->addColumn('detail', function ($row) {
            $button_edit = '';
            if ($row->status === 'Lulus') {
            $button_edit = "
            <a href=\"" . route('detail-user-edit-skk', ['id' => $row->id]) . "\" class=\"ms-auto text-white btn btn-primary ms-auto text-danger\">Lihat Hasil</a>
           ";
            }
            return $button_edit;
        })
        ->addColumn('action', function ($row) {
            $button_edit = '';
            if ($row->status === 'Lulus' ) {
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
        $pengajuanCollection = JawabanSKK::where('pengajuan', $id)->get();
        $pengajuanFirst = JawabanSKK::where('pengajuan', $id)->first();

        $aju = $pengajuanFirst->pengaju;
        $pengaju = User::where('id',$aju)->get();
        $uji = $pengajuanFirst->penguji;
        $penguji = User::where('id',$uji)->get();
    
        $pengajuanArray = $pengajuanCollection->toArray();
        $soal = [];
        $tanggal = [];
    
        foreach ($pengajuanCollection as $pengajuan) {
    
            $question = $pengajuan->soal;
            $soal[] = SoalSKK::where('id', $question)->first();

            $tanggal[] = $pengajuan->created_at;
        }
    
        return view('dashboard-user.detail-skk',compact('pengaju','penguji','soal','tanggal'));
    }

    public function tingkat(Request $request, $kategori)
    {
        $user_id = $request->user_id;
    
        $dataSkk = DataSkk::where('kategori', $kategori)
            ->where('id_user', $user_id)
            ->first();
    
            if ($dataSkk) {
                if ($dataSkk->nama_tingkat) {
                    $tingkatOptions = [$dataSkk->nama_tingkat];
                } else {
                    $tingkatOptions = TingkatSKK::where('id', $dataSkk->tingkat)->get();
                }
            } else {
                $tingkatOptions = TingkatSKK::where('id', 1)->get();
            }
    
        return response()->json($tingkatOptions);
    }
}
