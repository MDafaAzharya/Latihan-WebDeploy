<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSKU extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_sku';
    protected $id = 'id'; 
    protected $fillable = [
        'nama_lengkap',
        'tingkat',
        'angkatan',
        'penguji',
        'tanggal_pengajuan',
        'sertifikat',
        'status',
    ];

    public function nama_pengaju()
    {
        return $this->belongsTo(User::class, 'nama_lengkap', 'id');
    }
    public function nama_tingkat()
    {
        return $this->belongsTo(Tingkat::class, 'tingkat', 'id');
    }
    public function nama_penguji()
    {
        return $this->belongsTo(User::class, 'penguji', 'id');
    }
    public function nama_sertifikat()
    {
        return $this->belongsTo(SertifikatSKU::class, 'nama_lengkap', 'pengaju');
    }
}
