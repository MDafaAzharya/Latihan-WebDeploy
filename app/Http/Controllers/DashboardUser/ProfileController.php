<?php

namespace App\Http\Controllers\DashboardUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $id_user = Auth::user();
        $id = $id_user->id;
        return view('dashboard-user.profile.index', compact('id'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        //dd ($id);
        $request->validate([
            'nama' => 'required',
            'nomor' => 'required|numeric',
            'gender' =>'required',
            'nta'=>'required',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'agama'=>'required',
            'alamat_rumah'=>'required',
            'provinsi'=>'required',
            'kota'=>'required',
            'kecamatan'=>'required',
            'kode_pos'=>'required',
        ]);
        $data = [
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'jenis_kelamin' => $request->gender,
            'nta' => $request->nta,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat_rumah,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'sosmed_facebook' => $request->socmed_facebook, 
            'sosmed_instagram' => $request->socmed_instagram,
            'sosmed_tiktok' => $request->socmed_tiktok,
        ];
        DB::table('users')->where('id', $id)->update($data);
        return back()->with('success', 'Perubahan Berhasil di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function update_password(Request $request){
       // dd($request->password);
       return view('dashboard-user.profile.update-password');

    }

    public function store_new_password(Request $request){
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8',
        ]);
    
        // Get the authenticated user
        $user = Auth::user();
        // Check if the old password matches
        // dd($user);
    
        if (!Hash::check($request->currentPassword, $user->password)) {
            return 'salah';
        }
        $new = Hash::make($request->newPassword);
        $update = User::find(Auth::user()->id)->update([
          'password' => $new,
        ]);
        session()->flash('success', 'Password berhasil diubah');
        return back()->with('success','Berhasil Mengubah Password');
    }
    public function update_photo_profile(Request $request){
        // dd($request->all());
        $data = User::find(Auth::user()->id);
        if($request->hasFile('document_photo')){
            $file = $request->file('document_photo');
          $fileName = time() . '.' . $file->getClientOriginalExtension();
        //   dd($fileName);    
          $file->storeAs('public/assets/img/profile', $fileName);
            $data->gambar = $fileName;
            $data->update();
        }
        return back()->with('success','berhasil mengubah foto profil');
    }
}
