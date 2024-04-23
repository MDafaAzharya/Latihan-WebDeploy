<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    use HasFactory;
    protected $table = 'tingkat_sku';
    protected $id = 'id'; 
    protected $fillable = [
        'nama_tingkat',
    ];
}
