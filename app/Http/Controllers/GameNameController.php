<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TournamentName;
use App\Models\GameName;

class GameNameController extends Controller
{
    public function add(Request $request){


        $id=TournamentName::find($request->tournamentid);

        $id->game_names()->create([
            'name_of_game'=>$request->name
        ]);


        return ['message'=>'game added successfully'];
    }

    public function update(Request $request){
        $fields=$request->validate([
            'name_of_game'=>'required'
        ]);

        $id=GameName::find($request->id);

        $id->update($fields);

        return ['message'=>'game name updated'];
    }

    public function delete($id){
        GameName::destroy($id);

        return ['message'=>'game name deleted successfully'];
    }
}
