<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentName extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'details'
    ];

    public function game_names(){
        return $this->hasMany(GameName::class);
    }
}
