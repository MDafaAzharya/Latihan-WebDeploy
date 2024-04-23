<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
class BarangController extends Controller
{
    public function index()
    {
      $barang = Barang::all();
        return view('dashboard.profiletwo.barang', compact('barang'));
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
        //  dd($request->all());
        $request->validate([
          'nama' => 'required',
          'jumlah' => 'required',
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $data = $request->all();

        if ($request->file('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $image = $request->file('image')->storeAs('public/images', $originalFileName); 
            // Tambahkan nama file gambar ke data sebelum disimpan
            $data['gambar'] = $originalFileName;
        }
        $data['nama_barang'] = $request->input('nama');
        $data['jumlah_barang'] = $request->input('jumlah');
        $insert = Barang::create($data);

        return back()->with('success', 'Berhasil menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $data =  Barang::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama' => 'required',
            'jumlah' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    
        $data = Barang::find($request->id);
    
        // Cek apakah ada file gambar baru diunggah
        if ($request->hasFile('gambar')) {
            $originalFileName = $request->file('gambar')->getClientOriginalName();
    
            // Menghapus gambar sebelumnya jika ada
            if ($data->gambar) {
                Storage::delete('public/images/' . $data->gambar);
            }
    
            // Menyimpan gambar baru ke storage
            $image = $request->file('gambar')->storeAs('public/images', $originalFileName);
    
            // Mengupdate nama file gambar
            $data->gambar = $originalFileName;
        }
    
        $data->nama_barang = $request->nama;
        $data->jumlah_barang = $request->jumlah;
        $data->save();
    
        return back()->with('success', 'Berhasil mengubah data');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        
        if ($barang->gambar) {
        $imagePath = 'public/images/' . $barang->gambar;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        }
        $barang->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }
    public function datatable(){
        $data = Barang::all();
        return \Yajra\DataTables\DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('nama', function($row){
            return $row->nama_barang;
        })
        ->addColumn('jumlah', function($row){
            return $row->jumlah_barang;
        })
        ->addColumn('gambar', function ($row) {
            $imageUrl = asset("storage/images/{$row->gambar}");
            return $imageUrl;
        })
        ->addColumn('action', function($item){
            $button_delete = "<button class=\"btn btn-danger p-2 mx-1 btn-delete\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-trash\"></i></button>";
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-pencil\"></i></button>";

            return $button_delete . $button_edit;
          })
        ->rawColumns(['action'])
        ->make(true);
    }
}
