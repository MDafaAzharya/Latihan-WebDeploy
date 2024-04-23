<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSKU extends Model
{
    use HasFactory;
    protected $table = 'jawaban_sku';
    protected $id = 'id'; 
    protected $fillable = [
        'pengaju',
        'penguji',
        'soal',
        'status',
        'pengajuan',
    ];

    public function change_pengaju()
    {
        return $this->belongsTo(User::class, 'pengaju', 'id');
    }
    public function change_penguji()
    {
        return $this->belongsTo(User::class, 'penguji', 'id');
    }
    public function change_soal()
    {
        return $this->belongsTo(SoalSKU::class, 'soal', 'id');
    }
}
