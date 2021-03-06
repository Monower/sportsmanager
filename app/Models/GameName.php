<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameName extends Model
{
    use HasFactory;

    protected $fillable=[
        'name_of_game'
    ];

    public function team_name(){
        return $this->hasMany(Teamname::class);
    }
}
