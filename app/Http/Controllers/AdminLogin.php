<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;


class AdminLogin extends Controller
{
    public function login(){
        return ['message'=>'admin login form will be here'];
    }

    public function protected_login(Request $request){
        $fields=$request->validate([
            'email'=>'required|string',
            'password'=>'required'
        ]);

        $admin=admin::where('email',$fields['email'])->first();

        if(!$admin || !Hash::check($fields['password'], $admin->password)){
            return response([
                'message'=>'Incorrect email or password'
            ],401);
        }else{
            $token=$admin->createToken('myapptoken')->plainTextToken;

            $response=[
                'admin'=>$admin,
                'token'=>$token
            ];

             return response()->json($response, 200);
        }
    }

    public function registerManager(Request $request){

        $fields=$request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:managers,email',
            'password'=>'required|string|confirmed'

        ]);

        $manager=Manager::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>Hash::make($fields['password'])
        ]);

/*         $token=$manager->createToken('myapptoken')->plainTextToken; */

        $response=[
            'message'=>'manager created successfully'

        ];

        return response()->json($response, 200);
    }

    public function logout(Request $request){
        $id=$request->id;
        $tokenId=$request->tokenid;
        $admin=Admin::find($id)->first();

        $admin->tokens()->where('id',$tokenId)->delete();

        return [
            'message'=>'logged out'
        ];
    }

    public function deleteManager(Request $request){
        Manager::destroy($request->id);

        return [
            'message'=>'manager deleted'
        ];
    }
}
