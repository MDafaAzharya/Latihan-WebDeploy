<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatSKU extends Model
{
    use HasFactory;
    protected $table = 'sertifikat_sku';
    protected $id = 'id'; 
    protected $fillable = [
        'pangaju',
        'penguji',
        'nama_pengaju',
        'tempat_lahir',
        'tanggal_lahir',
        'tingkat',
        'nama_serti'
    ];
}
