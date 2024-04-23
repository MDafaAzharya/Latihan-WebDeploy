<?php

namespace App\Http\Controllers\DashboardUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoalSKU;
use App\Models\User;
use App\Models\Tingkat;
use App\Models\PengajuanSKU;
use App\Models\JawabanSKU;
use App\Models\SertifikatSKU;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class SoalSKUController extends Controller
{
        public function index(string $id){
        //dd($id);
            $penguji = Auth::user();
            $idpenguji = $penguji->id;
            $user = PengajuanSKU::find($id);
            $tingkat = $user->tingkat;
            $iduser = $user->nama_lengkap;
            $soalSKU = SoalSKU::where('kategori', $tingkat)->get();
            $nama_tingkat = Tingkat::where('id', $tingkat)->get();
            $nama_pengaju = User::where('id', $iduser)->get();
            $nama_penguji = User::where('id', $idpenguji)->get();
            $pengaju = SertifikatSKU::where('pengaju', $iduser)->get();
            $tempat = User::where('id',$iduser)->get();

            $semuaJawabanSudahTerjawab = true;
            foreach ($soalSKU as $soal) {
                $jumlahJawabanTerjawab = JawabanSKU::where('soal', $soal->id)
                    ->where('pengaju', $user->nama_lengkap)
                    ->where('status', 1)
                    ->count();
        
                if ($jumlahJawabanTerjawab === 0) {
                    $semuaJawabanSudahTerjawab = false;
                    break; // Hentikan perulangan jika ada soal yang belum terjawab
                }
            }

            return view("dashboard-user.soalsku",compact("soalSKU", 'user','nama_tingkat','nama_pengaju','semuaJawabanSudahTerjawab','nama_penguji','pengaju','tempat'));
        }

        public function update(Request $request)
        {
            //dd($request->all());
            $request->validate([
                'file' => 'required',
            ]);
            $data = $request->all();
            $data_update = PengajuanSKU::findOrFail($request->id);

            if ($request->file('file')) {
                $originalFileName = $request->file('file')->getClientOriginalName();
        
                // Menghapus file sebelumnya jika ada
                if ($data_update->sertifikat) {
                  $oldFilePath = public_path('sertifikat/' . $data_update->sertifikat);
                  if (File::exists($oldFilePath)) {
                      File::delete($oldFilePath);
                  }
                }
        
                $path = $request->file('file')->move(public_path('sertifikat'), $originalFileName);
        
                // Mengupdate nama file file
                $data_update->sertifikat = $originalFileName;
            }
            $data_update->update($data);
            return back()->with('success', 'Berhasil mengubah data');
    
        }

        public function jawaban(Request $request)
        {
            //dd($request->all());
            $penguji_id = auth()->user()->id;
            $soal_id = $request->input('soal_id');
            $pengaju_id = $request->input('pengaju_id');
            $status = $request->input('validasi') ? 1 : 0;
            $pengajuan = $request->input('pengajuan');
        
            // Simpan jawaban ke dalam database
            JawabanSKU::updateOrCreate(
                ['pengaju' => $pengaju_id, 'penguji' => $penguji_id, 'soal' => $soal_id, 'pengajuan' => $pengajuan],
                ['status' => $status]
            );
        
            return redirect()->back();
        }
}
