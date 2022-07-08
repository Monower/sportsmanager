<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(){
        return ['message'=>'login form will be here'];
    }

    public function addAdmin(Request $request){
        $fields=$request->validate([
            'name'=>'required',
            'designation'=>'required',
            'phone'=>'required|numeric|unique:admins,phone_number',
            'email'=>'required|email|unique:admins,email',
            'password'=>'required|min:8|confirmed'
        ]);


        Admin::create([
            'name'=>$request->name,
            'designation'=>$request->designation,
            'phone_number'=>$request->phone,
            'email'=>$request->email,
            'role'=>'admin',
            'password'=>Hash::make($request->password)
        ]);

        return ['message'=>'admin created successfully'];

    }

    public function edit(){
        return ['message'=>'an edit form will be here'];
    }

    public function update(Request $request){

        $request->validate([
            'id'=>'required'
        ]);

        $admin=Admin::find($request->id);


        if(isset($admin)){
            $admin->update($request->all());
            return ['message'=>'admin updated successfully'];
        }else{
            return ['message'=>'no record found'];
        }

        
        
    }

    public function delete($id){


        $admin=Admin::find($id);

        if(isset($admin)){
            Admin::destroy($id);
            return ['message'=>'admin is deleted successfully'];
        }else{
            return ['message'=>'no record found to delete'];
        }
        

        
    }

    public function admin_login(Request $request){

        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $email= Admin::where('email','=',$request->email)->first();

        if(Hash::check($request->password, $email->password)){
            return redirect(route('tournamentdash'));
        }else{
            return ['message'=>'creds dont match'];
        }
    }

    
}
