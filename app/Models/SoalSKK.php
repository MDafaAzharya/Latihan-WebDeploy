<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalSKK extends Model
{
    use HasFactory;
    protected $table = 'soal_skk';
    protected $id = 'id'; 
    protected $fillable = [
        'soal',
        'kategori',
        'kategori_khusus',
    ];

    public function nama_tingkat()
    {
        return $this->belongsTo(TingkatSKK::class, 'kategori', 'id');
    }
    public function nama_kategori()
    {
        return $this->belongsTo(KategoriSKK::class, 'kategori_khusus', 'id');
    }
}
