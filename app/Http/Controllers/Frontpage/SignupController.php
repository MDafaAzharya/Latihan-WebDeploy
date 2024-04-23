<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterPengajuan;

class SignupController extends Controller
{
        public function signup(Request $request)
        {
            //dd($request->all());
            $request->validate([
                'nama' => 'required',
                'email' => 'required',
                'angkatan' => 'required',
                'nomor' => 'required',
                'role' => 'required',
                'tingkat' => 'required',
                'tingkat_skk' => 'required',
                'password' => 'required',
            ]);
            $data = $request->all();
            $data['nama'] = $request->input('nama');
            $data['email'] = $request->input('email');
            $data['angkatan'] = $request->input('angkatan');
            $data['nomor'] = $request->input('nomor');
            $data['role'] = $request->input('role');
            $data['tingkat'] = $request->input('tingkat');
            $data['tingkat_skk'] = $request->input('tingkat_skk');
            $data['password'] = $request->input('password');
            $insert = RegisterPengajuan::create($data);
    
            return back()->with('success', 'Akun berhasil dibuat, Silahkan tunggu verifikasi dari Admin!!!');
        }
}
