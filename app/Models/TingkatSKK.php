<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatSKK extends Model
{
    use HasFactory;
    protected $table = 'tingkat_skk';
    protected $id = 'id'; 
    protected $fillable = [
        'nama_tingkat',
    ];
}
