<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Teamname;
use Illuminate\Support\Facades\Hash;
use App\Models\GameName;

class TeamNameController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'team_name'=>'required|max:16',
            'name_of_manager'=>'required',
            'number_of_player'=>'required|numeric',
            'logo'=>'file|mimes:jpg,jpeg,png',
            'password'=>'required|min:8|max:12|confirmed',
            'game_name_id'=>'required'
        ]);

        $id=GameName::find($request->gmae_name_id);

        dd($id->name_of_game);

        if($id != null){
            $newfilename= time().'-'.$request->team_name.'.'.$request->logo->extension();
            Storage::disk('public')->put($newfilename, file_get_contents($request->file('logo')));
    
            
            $message=$id->team_name()->create([
                'team_name'=>$request->team_name,
                'name_of_manager'=>$request->name_of_manager,
                'number_of_player'=>$request->number_of_player,
                'logo'=>$newfilename,
                'password'=>Hash::make($request->password),
                'game_name_id'=>$request->game_name_id
            ]);
    
    
            if($message){
                return ['message'=>'registered successfully'];
            }else{
                return ['message'=>'not registered successfully'];
            }
        }else{
            return ['message'=>'wrong game id'];
        }



    }
}
