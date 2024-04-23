<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoalSKK;
use App\Models\TingkatSKK;
use App\Models\KategoriSKK;

class SKKController extends Controller
{
    public function index()
    {
        $tingkat = TingkatSKK::all();
        $pengajuan_sku = SoalSKK::all();
        $kategori_khusus = KategoriSKK::all();
        return view('dashboard.profiletwo.skk', compact('pengajuan_sku','tingkat','kategori_khusus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
          'nama' => 'required',
          'tingkat' => 'required',
          'kategori' => 'required',
        ]);
        $data = $request->all();
        $data['soal'] = $request->input('nama');
        $data['kategori'] = $request->input('tingkat');
        $data['kategori_khusus'] = $request->input('kategori');
        $insert = SoalSKK::create($data);

        return back()->with('success', 'Berhasil menambahkan Data');
    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $data = SoalSKK::with('nama_tingkat')->find($id);
        
        $responseData = [
            'id' => $data->id,
            'soal' => $data->soal,
            'kategori' => $data->kategori,
            'kategori_khusus' => $data->kategori_khusus,
            'tingkat' => $data->nama_tingkat->nama_tingkat,
            // tambahkan kolom-kolom lain sesuai kebutuhan
        ];
        return response()->json($responseData);
    }
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama' => 'required',
            'tingkat' => 'required',
            'kategori_edit' => 'required',
        ]);
        $data = $request->all();
        $data_update = SoalSKK::findOrFail($request->id);
        $data_update->soal = $request->nama;
        $data_update->kategori = $request->tingkat;
        $data_update->kategori_khusus = $request->kategori_edit;
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah data');

    }
    public function destroy(string $id)
    {
        $SoalSKK = SoalSKK::findOrFail($id);
        $SoalSKK->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }
    public function datatable(){
        $query = SoalSKK::with('nama_tingkat')->get();
        return \Yajra\DataTables\DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('nama', function($row){
            return $row->soal;
        })
        ->addColumn('tingkat', function($row){
            return $row->nama_tingkat->nama_tingkat;
        })
        ->addColumn('kategori', function($row){
            return $row->nama_kategori->nama_kategori;
        })
        ->addColumn('action', function($item){
            $button_delete = "<button class=\"btn btn-danger p-2 mx-1 btn-delete\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-trash\"></i></button>";
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-pencil\"></i></button>";

            return $button_delete . $button_edit ;
          })
        ->rawColumns(['action'])
        ->make(true);
    }
}
