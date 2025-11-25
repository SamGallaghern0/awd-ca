<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_id',
        'rating',
        'comment',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);   /*Has a one to many relationship with score.*/
    }

    public function user()
    {
        return $this->belongsTo(User::class);   /*Has a one to many relationship with user.*/
    }
}
