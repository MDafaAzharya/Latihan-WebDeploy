<?php

namespace App\Http\Controllers\DashboardUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\SertifikatSKU;
use App\Models\PengajuanSKU;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SertifikatSKUController extends Controller
{
    protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function fpdf(Request $request) 
    {
        //dd($request->all());
        $data_update = PengajuanSKU::where('nama_lengkap', $request->input('pengaju'))->first();
        $data_update->status = 'Lulus'; 
        $data_update->save();
    
        $user = User::where('id', $request->input('pengaju'))->first();
        $tingkatSaatIni = $user->tingkat;
    
        $tingkatBaru = $tingkatSaatIni + 1; 
        $user->tingkat = $tingkatBaru;
        $user->save();

        $data = SertifikatSKU::where('pengaju', $request->input('pengaju'))->firstOrNew();
        $pengaju = $request->input('pengaju');
        $penguji = $request->input('penguji');
        $nama = $request->input('nama');
        $tempat = $request->input('tempat');
        $tanggal = $request->input('tanggal');
        $tingkat = $request->input('tingkat');

        $data->pengaju = $pengaju;
        $data->penguji = $penguji;
        $data->nama_pengaju = $nama;
        $data->tempat_lahir = $tempat;
        $data->tanggal_lahir = $tanggal;
        $data->tingkat = $tingkat;

        //file manage
      
        $pdfContent = $this->generatepdf($nama, $tempat, $tanggal, $tingkat);
        $pdfFileName = 'sertifikat_sku_' . $data->nama_pengaju . $data->tingkat . $data->pengaju . '.pdf';
        $pdfFilePath = public_path('sertifikat/' . $pdfFileName);
        $data->nama_serti =  $pdfFileName;

        if (Storage::exists($pdfFileName)) {
            Storage::delete($pdfFileName);
        }

        File::put($pdfFilePath, $pdfContent);
      
        $data->save();
     
        return back()->with('success', 'Berhasil Mengirim Sertifikat');
    }

    

    public function generatepdf($nama, $tempat, $tanggal, $tingkat){
        ob_start();
    
        $this->fpdf->AddPage('P','A4');
        $this->fpdf->Image(public_path("sertifikat/bingkai.png"), -18, -25, 240,340); 
        $this->fpdf->Image(public_path("sertifikat/logo-bantara.png"), 80, 40, 50,50); 
        $this->fpdf->SetX(20);
        $this->fpdf->SetY(90);

        $this->fpdf->SetFont('Times', 'B', 18);        
        $this->fpdf->Cell(0, 10, 'Surat Keterangan' , 0, 1, 'C');
    
        $this->fpdf->SetFont('Arial', '', 12);

        //Data Diri
        $this->fpdf->SetX(30); 
        $this->fpdf->Cell(0, 8, 'Diberikan Kepada :', 0, 1, 'L');
        $this->fpdf->SetY(115); 
        $this->fpdf->SetX(30); 
        $this->fpdf->Cell(0, 8, 'Nama Penerima', 0, 1, 'L');        
        $this->fpdf->SetX(30); 
        $this->fpdf->Cell(0, 8, 'Tempat/Tanggal Lahir', 0, 1, 'L');
        $this->fpdf->SetX(30); 
        $this->fpdf->Cell(0, 8, 'Tingkatan', 0, 1, 'L');
        
        $this->fpdf->SetY(115); 
        $this->fpdf->SetX(80); 
        $this->fpdf->Cell(0, 8, ':', 0, 1, 'L');        
        $this->fpdf->SetX(80); 
        $this->fpdf->Cell(0, 8, ':', 0, 1, 'L');
        $this->fpdf->SetX(80); 
        $this->fpdf->Cell(0, 8, ':', 0, 1, 'L');

        $this->fpdf->SetY(115); 
        $this->fpdf->SetX(90); 
        $this->fpdf->Cell(0, 8, $nama, 0, 1, 'L');        
        $this->fpdf->SetX(90); 
        $this->fpdf->Cell(0, 8, $tempat . ' / ' . date('d-M-Y', strtotime($tanggal)), 0, 1, 'L');
        $this->fpdf->SetX(90); 
        $this->fpdf->Cell(0, 8, $tingkat, 0, 1, 'L');
    
        //Ucapan Selamat
        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->SetY(150);         
        $this->fpdf->SetX(30); 
        $this->fpdf->MultiCell(150, 8, "Yang Telah menyelesaikan syarat-syarat khusus tersebut diatas, sesuai Surat Keputusan Kwartir Nasional Nomor 198 Tahun 2011 dan berhak untuk mengenakan Tanda Kecakapan Umumnya. Dengan harapan untuk senantiasa meningkatkan keterampilan dan pengetahuannya berdasarkan Tri Satya dan Dasa Darma Pramuka.", 0, 'L');

        //TTD
        $this->fpdf->SetFont('Times', 'B', 12);
        $this->fpdf->SetY(190); 
        $this->fpdf->SetX(120); 
        $this->fpdf->Cell(0, 7, 'Di Tetapkan di Kuningan',  0, 1, 'L');
        $this->fpdf->SetX(120); 
        $this->fpdf->Cell(0, 7, 'Pada Tanggal 30 November 2017',  0, 1, 'L');
        $this->fpdf->SetX(120); 
        $this->fpdf->Cell(0, 7, 'GUGUS DEPAN 09-129',  0, 1, 'L');
        $this->fpdf->SetX(120); 
        $this->fpdf->Cell(0, 7, 'Pembina,',  0, 1, 'L');

        $this->fpdf->SetY(250); 
        $this->fpdf->SetX(120); 
        $this->fpdf->Cell(0, 7, 'Drs. AbduMutcholib M.M',  0, 1, 'L');
        $this->fpdf->SetX(120); 
        $this->fpdf->Cell(0, 7, 'NTA. 09.08.025252',  0, 1, 'L');
        
        $this->fpdf->Output();

        return  ob_get_clean();
   }

}
