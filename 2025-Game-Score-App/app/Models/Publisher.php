<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'bio',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class);   /*Has a many to many relationship with game.*/
    }
}
