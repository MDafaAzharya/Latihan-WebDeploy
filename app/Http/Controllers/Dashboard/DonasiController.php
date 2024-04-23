<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Models\Donasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Crypt;

class DonasiController extends Controller
{
    function index(){
      return view('dashboard.donasi.index');
    }

    function datatables(){
      $query = Donasi::with('kategori');

      return datatables()->of($query)
            ->addIndexColumn()
            ->addColumn('action', function($item){
              $button_delete = "<button class=\"btn btn-danger p-2 mx-1 btn-delete\" data-id=\"".Crypt::encryptString($item->id)."\"><i class=\"tf-icons ti ti-trash\"></i></button>";
              $button_edit = "<a class=\"btn btn-success p-2 mx-1 \" href=\"".route('donasi.edit', [Crypt::encryptString($item->id)])."\"><i class=\"tf-icons ti ti-edit\"></i></a>";

              return $button_delete.$button_edit;
            })
            ->editColumn('gender', function($item){
              switch ($item->gender) {
                case 'L':
                  return "Laki-laki";
                case 'P':
                  return "Perempuan";
                default:
                  return "";
              }
            })
            ->editColumn('birthdate', function($item){
              return  date('d F Y', strtotime($item->birthdate));
            })->toJson();
    }

    function create(){
      $kategori = Kategori::all();
      return view('dashboard.donasi.create', ['kategori' => $kategori]);
    }

    function save(Request $request){
      $request->validate([
        'referensi' => 'required',
        'nama' => 'required',
        'gender' => 'required',
        'kategori' => 'required',
        'kode_user' => 'required|unique:donasi,unique_id'
      ]);

      try {
        $donasi = new Donasi();
        $donasi->kategori_id = $request->kategori;
        $donasi->referensi = $request->referensi;
        $donasi->unit_kerja = $request->unit_kerja;
        $donasi->wilayah = $request->wilayah;
        $donasi->name = $request->nama;
        $donasi->phone = $request->no_hp;
        $donasi->email = $request->email;
        $donasi->birthdate = $request->tgl_lahir;
        $donasi->gender = $request->gender;
        $donasi->unique_id = $request->kode_user;
        $donasi->save();

        return redirect(route('donasi.get'))->with('success', 'Data berhasil disimpan !');
      } catch (\Throwable $th) {
        return redirect()->back()->withInput()->withErrors(["error_message", $th->getMessage()]);
      }
    }

    function edit($id){
      try {
        $donasi = Donasi::findOrFail(Crypt::decryptString($id));
        $kategori = Kategori::all();

        return view('dashboard.donasi.edit', ['donasi' => $donasi, 'kategori' => $kategori]);
      } catch (\Throwable $th) {
        abort(500, $th->getMessage());
      }
    }

    function update(Request $request, $id){
      $request->validate([
        'referensi' => 'required',
        'nama' => 'required',
        'gender' => 'required',
        'kategori' => 'required',
      ]);

      try {
        $donasi = Donasi::findOrFail(Crypt::decryptString($id));
        $donasi->kategori_id = $request->kategori;
        $donasi->referensi = $request->referensi;
        $donasi->unit_kerja = $request->unit_kerja;
        $donasi->wilayah = $request->wilayah;
        $donasi->name = $request->nama;
        $donasi->phone = $request->no_hp;
        $donasi->email = $request->email;
        $donasi->birthdate = $request->tgl_lahir;
        $donasi->gender = $request->gender;
        $donasi->save();

        return redirect(route('donasi.get'))->with('success', 'Data berhasil diupdate !');
      } catch (\Throwable $th) {
        return redirect()->back()->withInput()->withErrors(["error_message", $th->getMessage()]);
      }

    }


    function delete($id){
      try {
        $donasi = Donasi::findOrFail(Crypt::decryptString($id));
        $donasi->delete();

        return response()->json('ok');
      } catch (\Throwable $th) {
        abort(500, $th->getMessage());
      }
    }
}
