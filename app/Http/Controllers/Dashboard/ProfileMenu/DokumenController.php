<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\KategoriDokumen;
use Illuminate\Support\Facades\File;
class DokumenController extends Controller
{
  public function index()
  {
    $dokumen = Dokumen::all();
    $katdokumen = KategoriDokumen::all();
      return view('dashboard.profiletwo.dokumen', compact('dokumen' , 'katdokumen'));
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
        'file' => 'required|mimes:pdf,doc,docx,xls,xlsx',      
        'kategori'=> 'required',
      ]);
      $data = $request->all();

      if ($request->hasFile('file')) {
        $originalFileName = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->move(public_path('document'), $originalFileName);

        // Tambahkan nama file dokumen ke data sebelum disimpan
        $data['name_file'] = $originalFileName;
    }
      $data['name'] = $request->input('nama');
      $data['kategori'] = $request->input('kategori');
      $insert = Dokumen::create($data);

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
     $data =  Dokumen::find($id);
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
      // dd($request->all());
      $request->validate([
          'nama' => 'required',
          'file' => 'required|mimes:pdf,doc,docx,xls,xlsx', 
          'kategori'=> 'required',
      ]);
      $data = Dokumen::find($request->id);      

      if ($request->file('file')) {
          $originalFileName = $request->file('file')->getClientOriginalName();
  
          // Menghapus file sebelumnya jika ada
          if ($data->name_file) {
            $oldFilePath = public_path('document/' . $data->name_file);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
          }
  
          $path = $request->file('file')->move(public_path('document'), $originalFileName);
  
          // Mengupdate nama file file
          $data->name_file = $originalFileName;
      }
      $data->name = $request->nama;
      $data->kategori = $request->kategori;
      $data->save();
      return back()->with('success', 'Berhasil mengubah data');

  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
      $file = Dokumen::findOrFail($id);
      
      if ($file->name_file) {
      $nama_file = public_path('document/' . $file->name_file);
      if (File::exists($nama_file)) {
          File::delete($nama_file);
      }
      }
      $file->delete();
      return back()->with('success', 'Berhasil menghapus data');
  }
  public function datatable(){
    $query = Dokumen::with('check_kategori')->get();
    return datatables()->of($query)
      ->addIndexColumn()
      ->addColumn('name', function($row){
          return $row->name;
      })
      ->addColumn('file', function($row){
          return $row->name_file;
      })
      ->addColumn('kategori', function($row){
        return $row->check_kategori->name;
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
