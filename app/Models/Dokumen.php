<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';
    protected $id = 'id';
    protected $fillable = [
        'name',
        'name_file',
        'kategori',
    ];

    public function check_kategori()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori', 'id');
    }
}
