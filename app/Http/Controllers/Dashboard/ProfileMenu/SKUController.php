<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoalSKU;
use App\Models\Tingkat;

class SKUController extends Controller
{
    public function index()
    {
        $tingkat = Tingkat::all();
        $pengajuan_sku = SoalSKU::all();
        return view('dashboard.profiletwo.sku', compact('pengajuan_sku','tingkat'));
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
        ]);
        $data = $request->all();
        $data['soal'] = $request->input('nama');
        $data['kategori'] = $request->input('tingkat');
        $insert = SoalSKU::create($data);

        return back()->with('success', 'Berhasil menambahkan Data');
    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $data = SoalSKU::with('nama_tingkat')->find($id);
        
        $responseData = [
            'id' => $data->id,
            'soal' => $data->soal,
            'kategori' => $data->kategori,
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
        ]);
        $data = $request->all();
        $data_update = SoalSKU::findOrFail($request->id);
        $data_update->soal = $request->nama;
        $data_update->kategori = $request->tingkat;
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah data');

    }
    public function destroy(string $id)
    {
        $SoalSKU = SoalSKU::findOrFail($id);
        $SoalSKU->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }
    public function datatable(){
        $query = SoalSKU::with('nama_tingkat')->get();
        return \Yajra\DataTables\DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('nama', function($row){
            return $row->soal;
        })
        ->addColumn('tingkat', function($row){
            return $row->nama_tingkat->nama_tingkat;
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
