<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalSKU extends Model
{
    use HasFactory;
    protected $table = 'soal_sku';
    protected $id = 'id'; 
    protected $fillable = [
        'soal',
        'kategori',
    ];

    public function nama_tingkat()
    {
        return $this->belongsTo(Tingkat::class, 'kategori', 'id');
    }
    public function change_soal()
    {
        return $this->belongsTo(JawabanSKU::class, 'id', 'pengajuan');
    }
}
