<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TournamentName;

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

    public function add(Request $request){

        $fields=$request->validate([
            'name'=>'required|unique:tournament_names,name',
            'details'=>'required'
        ]);

        TournamentName::create($fields);

        return ['message'=>'tournament created successfully'];
    }

    public function update(Request $request){
        $fields=$request->validate([
            'name'=>'required',
            'details'=>'required'
        ]);

        $data=TournamentName::find($request->id);

        $data->update($fields);

        return ['message'=>'details of tournament updated'];
    }

    public function delete($id){
        TournamentName::destroy($id);

        return ['message'=>'tournament deleted successfully'];
    }
}
