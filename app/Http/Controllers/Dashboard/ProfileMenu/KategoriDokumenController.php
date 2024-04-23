<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriDokumen;

class KategoriDokumenController extends Controller
{
    public function index()
    {
      $KategoriDokumen = KategoriDokumen::all();
        return view('dashboard.profiletwo.kategori-dokumen', compact('KategoriDokumen'));
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
          'name' => 'required',
        ]);
        $data = $request->all();

        $insert = KategoriDokumen::create($data);

        return back()->with('success', 'Berhasil menambahkan Data');
    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
       $data =  KategoriDokumen::find($id);
        // dd($data);

        return response()->json($data);
    }
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
        ]);
        $data = $request->all();
        $data_update = KategoriDokumen::findOrFail($request->id);
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah data');

    }
    public function destroy(string $id)
    {
        $KategoriDokumen = KategoriDokumen::findOrFail($id);
        $KategoriDokumen->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }
    public function datatable(){
        $data = KategoriDokumen::all();
        return \Yajra\DataTables\DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('name', function($row){
            return $row->name;
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
