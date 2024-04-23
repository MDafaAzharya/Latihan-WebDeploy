<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adart extends Model
{
    use HasFactory;

    
    protected $table = 'ad_art';
    protected $id = 'id'; 
    protected $fillable = [
        'text'
    ];
}
