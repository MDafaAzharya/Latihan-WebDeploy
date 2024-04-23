<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSKK extends Model
{
    use HasFactory;

    protected $table = 'kategori_khusus_skk';
    protected $id = 'id';
    protected $fillable = [
        'id',
        'nama_kategori',
    ];
    public function khusus()
    {
        return $this->hasMany(SoalSKK::class, 'kategori_khusus', 'id');
    }
}
