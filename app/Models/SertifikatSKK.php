<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatSKK extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_skk';
    protected $id = 'id'; 
    protected $fillable = [
        'pangaju',
        'penguji',
        'nama_pengaju',
        'tempat_lahir',
        'tanggal_lahir',
        'tingkat',
        'kategori',
        'nama_serti'
    ];
}
