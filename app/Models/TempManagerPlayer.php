<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempManagerPlayer extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'email',
        'phone',
        'type',
        'team_name',
        'number_of_players',
        'name_of_game',
        'country',
        'logo',
        'star_player'
    ];
}
