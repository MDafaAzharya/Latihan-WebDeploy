<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $id = 'id';
    protected $fillable = [
        'nama_barang',
        'jumlah_barang',
        'gambar',
    ];
}
