<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teamname extends Model
{
    use HasFactory;

    protected $fillable=[
        'team_name',
        'name_of_manager',
        'number_of_player',
        'logo',
        'password',
        'game_name_id '
    ];

    public function team_member_info(){
        return $this->hasMany(TeamMemberInfo::class,'team_name_id');
    }
}
