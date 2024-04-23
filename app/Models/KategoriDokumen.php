<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDokumen extends Model
{
    use HasFactory;

    protected $table = 'kategori_dokumen';
    protected $id = 'id';
    protected $fillable = [
        'name',
    ];

    public function dokumen(){
        return $this->hasMany(Dokumen::class,'kategori', 'id');
    }
}
