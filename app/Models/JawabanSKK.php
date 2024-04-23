<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSKK extends Model
{
    use HasFactory;
    protected $table = 'jawaban_skk';
    protected $id = 'id'; 
    protected $fillable = [
        'pengaju',
        'penguji',
        'soal',
        'status',
        'pengajuan',
    ];
}
