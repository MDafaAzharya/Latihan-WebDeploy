<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepengurusan extends Model
{
    use HasFactory;
    
    protected $table = 'kepengurusan';
    protected $id = 'id'; 
    protected $fillable = [
        'text'
    ];
}
