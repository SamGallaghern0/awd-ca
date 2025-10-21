<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [  /*The database layout.*/
        'title',
        'genre',
        'description',
        'year',
        'image',
        'created_at',
        'updated_at',
    ];
}
