<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriSKK;

class KategoriSKKController extends Controller
{
    public function index()
    {
      $KategoriSKK = KategoriSKK::all();
        return view('dashboard.profiletwo.kategori-skk', compact('KategoriSKK'));
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
        ]);
        $data = $request->all();
        $data['nama_kategori']=$request->input('nama');
        $insert = KategoriSKK::create($data);

        return back()->with('success', 'Berhasil menambahkan Data');
    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
       $data =  KategoriSKK::find($id);
        // dd($data);

        return response()->json($data);
    }
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama' => 'required',
        ]);
        $data = $request->all();
        $data_update = KategoriSKK::findOrFail($request->id);
        $data_update->nama_kategori=$request->nama;
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah data');

    }
    public function destroy(string $id)
    {
        $KategoriSKK = KategoriSKK::findOrFail($id);
        $KategoriSKK->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }
    public function datatable(){
        $data = KategoriSKK::all();
        return \Yajra\DataTables\DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('name', function($row){
            return $row->nama_kategori;
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
