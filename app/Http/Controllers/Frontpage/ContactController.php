<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Kontak::all();
        return view("contact",compact('contact'));
    }

    public function email(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'subjek' => 'required',
        'pesan' => 'required',
    ]);

    $nama = $request->input('nama');
    $email = $request->input('email');
    $subjek = $request->input('subjek');
    $pesan = $request->input('pesan');
    $kontak = Kontak::first();

    if ($kontak) {
        $emailTo = $kontak->email_to;

        // Kirim email
        Mail::send('email', ['nama' => $nama, 'pesan' => $pesan], function ($message) use ($email, $subjek, $emailTo) {
            $message->to($emailTo)
                ->subject($subjek)
                ->replyTo($email);
        });
        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    } else {
        return redirect()->back()->with('error', 'Data kontak tidak ditemukan.');
    }
}
}
