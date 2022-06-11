<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields=$request->validate([
            'email'=>'required|email|string',
            'password'=>'required|min:8'
        ]);

        $admin=Admin::where('email',$fields['email'])->first();

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:managers,email',
            'password'=>'required|min:8|string|confirmed'

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Manager::destroy($request->id);

        return [
            'message'=>'manager deleted'
        ];
    }
}
