<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konten;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KontenController extends Controller
{
    public function index()
    {
      $konten = Konten::all();
        return view('dashboard.profiletwo.konten', compact('konten'));
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
          'judul' => 'required',
          'text' => 'required',
          'kategori' => 'required',
          'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->file('gambar')) {
            $originalFileName = $request->file('gambar')->getClientOriginalName();
            $image = $request->file('gambar')->storeAs('public/images', $originalFileName); 
            // Tambahkan nama file gambar ke data sebelum disimpan
        }
        $data = [
            'title' => $request->judul,
            'slug' => Str::slug($request->judul),
            'text' => $request->text,
            'kategori' => $request->kategori,
            'image' => $originalFileName,
        ];
        DB::table('konten')->insert($data);
        return back()->with('success', 'Berhasil menambahkan Data');
    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
       $data =  Konten::find($id);
        //dd($data);

        return response()->json($data);
    }
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'judul' => 'required',
            'text' => 'required',
            'kategori'=> 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    
        $data = Konten::find($request->id);
    
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
        $data->kategori = $request->kategori;
        $data->save();
    
        return back()->with('success', 'Berhasil mengubah data');
    }
    public function destroy(string $id)
    {
        $Konten = Konten::findOrFail($id);
        
        if ($Konten->image) {
        $imagePath = 'public/images/' . $Konten->image;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        }
        $Konten->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }
    public function datatable(){
        $data = Konten::all();
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
        ->addColumn('kategori', function($row){
            return $row->kategori;
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
