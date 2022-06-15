<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempManagerPlayer;
use App\Models\Manager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

class ManagerPlayerController extends Controller
{
    public function applicants(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:foreign_managers',
            'phone'=>'required|numeric|unique:foreign_managers',
            'type'=>'required|string',
            'team_name'=>'required|string',
            'number_of_players'=>'required|numeric',
            'name_of_game'=>'required|string',
            'country'=>'required|string',
            'logo'=>'required|mimes:jpeg,png|max:2048'
        ]);

        $newImgName= time().'-'.$request->name.'.'.$request->logo->extension();
        
        //$logo_path=$request->file('logo')->store('logos');
        $request->logo->move(public_path('logos'),$newImgName);

        TempManagerPlayer::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'type'=>$request->type,
            'team_name'=>$request->team_name,
            'number_of_players'=>$request->number_of_players,
            'name_of_game'=>$request->name_of_game,
            'country'=>$request->country,
            'logo'=>$newImgName
        ]);

        $response=[
            'message'=>'applied successfully'
        ];

        return response()->json($response, 200);
    }
}
