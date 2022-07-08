<?php

namespace App\Http\Controllers;

use App\Models\Teamname;
use Illuminate\Http\Request;

class TeamMemberInfoController extends Controller
{
    public function add_member(Request $request){

        $request->validate([
            'team_name'=>'required',
            'name'=>'required',
            'student_id'=>'required|numeric|unique:team_member_infos,student_id'
        ]);

        $id= Teamname::where('team_name',$request->team_name)->first();

        if(isset($id)){
            $count_team_info=count($id->team_member_info()->get());

            $count_number_of_player= $id->number_of_player;

            if($count_team_info<$count_number_of_player){
                $id->team_member_info()->create([
                    'name'=>$request->name,
                    'student_id'=>$request->student_id
                ]);

                return ['message'=>'player added successfully'];
            }else{
                return ['message'=>'maximum number of player already added'];
            }

        }else{
            return ['message'=>'no record found'];
        }

        return $request->all();
    }
}
