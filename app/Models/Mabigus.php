<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mabigus extends Model
{
    use HasFactory;
    protected $table = 'mabigus';
    protected $id = 'id'; 
    protected $fillable = [
        'text'
    ];
}
