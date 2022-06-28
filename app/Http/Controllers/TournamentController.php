<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    public function index(){
        return ['message'=>'an admin tournament login page will be here'];
    }

    public function login(Request $request){

        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);

        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect(route('tournamentdash'));
        }else{
            return ['message'=>'credentials dont match'];
        }
        return $request->all();
    }

    public function tournamentDash(){
        return ['message'=>'this is tournament dashboard'];
    }
}
