<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterPengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_register';
    protected $id = 'id'; 
    protected $fillable = [
        'nama',
        'email',
        'nomor',
        'angkatan',
        'tingkat',
        'tingkat_skk',
        'password',
        'role',
    ];
}
