<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Storage;


class PrestasiController extends Controller
{
    public function index()
    {
      $prestasi = Prestasi::all();
        return view('dashboard.profiletwo.prestasi', compact('prestasi'));
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
          'judul' => 'required',
          'text' => 'required',
          'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $data = $request->all();

        if ($request->file('gambar')) {
            $originalFileName = $request->file('gambar')->getClientOriginalName();
            $image = $request->file('gambar')->storeAs('public/images', $originalFileName); 
            // Tambahkan nama file gambar ke data sebelum disimpan
            $data['image'] = $originalFileName;
        }
        $data['title'] = $request->input('judul');
        $insert = Prestasi::create($data);

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
       $data =  Prestasi::find($id);
    //    dd($data);
    // $imgUrl = asset("storage/images/".$data->image);
    // dd($imgUrl);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'judul' => 'required',
            'text' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    
        $data = Prestasi::find($request->id);
    
        // Cek apakah ada file gambar baru diunggah
        if ($request->hasFile('gambar')) {
            $originalFileName = $request->file('gambar')->getClientOriginalName();
    
            // Menghapus gambar sebelumnya jika ada
            if ($data->image) {
                Storage::delete('public/images/' . $data->image);
            }
    
            // Menyimpan gambar baru ke storage
            $image = $request->file('gambar')->storeAs('public/images', $originalFileName);
    
            // Mengupdate nama file gambar
            $data->image = $originalFileName;
        }
    
        $data->title = $request->judul;
        $data->text = $request->text;
        $data->save();
    
        return back()->with('success', 'Berhasil mengubah data');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        if ($prestasi->image) {
        $imagePath = 'public/images/' . $prestasi->image;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        }
        $prestasi->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }
    public function datatable(){
        $data = Prestasi::all();
        return \Yajra\DataTables\DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('judul', function($row){
            return $row->title;
        })
        ->addColumn('text_short', function ($row) {
            return mb_substr(strip_tags($row->text), 0, 30) . '...';
        })
        ->addColumn('text_full', function ($row) {
            return strip_tags($row->text);
        })
        ->addColumn('gambar', function ($row) {
            $imageUrl = asset("storage/images/{$row->image}");
            return $imageUrl;
        })
        ->addColumn('action', function($item){
            $button_delete = "<button class=\"btn btn-danger p-2 mx-1 btn-delete\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-trash\"></i></button>";
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-pencil\"></i></button>";
            $button_expand = "<button class=\"btn btn-info p-2 mx-1 btn-expand\" data-id=\"" . $item->id . "\"><i class=\"tf-icons ti ti-eye\"></i></button>";

            return $button_delete . $button_edit . $button_expand;
          })
        ->rawColumns(['action'])
        ->make(true);
    }
}
