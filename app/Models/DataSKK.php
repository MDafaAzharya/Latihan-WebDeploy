<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSKK extends Model
{
    use HasFactory;
    protected $table = 'data_skk';
    protected $id = 'id';
    protected $fillable = [
        'id_user',
        'kategori',
        'tingkat',
    ];

    public function nama_tingkat()
    {
        return $this->belongsTo(TingkatSKK::class, 'tingkat', 'id');
    }
}
