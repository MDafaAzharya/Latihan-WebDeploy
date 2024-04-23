<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSKK extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_skk';
    protected $id = 'id'; 
    protected $fillable = [
        'nama_lengkap',
        'tingkat',
        'angkatan',
        'kategori',
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
        return $this->belongsTo(TingkatSKK::class, 'tingkat', 'id');
    }
    public function nama_penguji()
    {
        return $this->belongsTo(User::class, 'penguji', 'id');
    }
    public function nama_sertifikat()
    {
        return $this->belongsTo(SertifikatSKK::class, 'nama_lengkap', 'pengaju');
    }
    public function nama_kategori()
    {
        return $this->belongsTo(KategoriSKK::class, 'kategori', 'id');
    }
}
