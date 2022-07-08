<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\GameNameController;
use App\Http\Controllers\TeamMemberInfoController;
use App\Http\Controllers\TeamNameController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


 //public routes
/*  Route::get('adminlogin',[AdminLogin::class,'login']);
 Route::post('adminlogin',[AdminLogin::class,'protected_login']);
 Route::post('request',[ManagerPlayerController::class,'applicants']); */

 //protected routes
/* Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('addmanager',[AdminLogin::class,'registerManager']);
    Route::post('adminlogout',[AdminLogin::class,'logout']);
    Route::delete('deletemanagers',[AdminLogin::class,'deleteManager']);
}); */

/* Route::resource('admin', AdminController::class);
 */

 Route::prefix('admin')->group(function(){
    Route::get('login',[AdminController::class,'login']);
    Route::post('login',[AdminController::class,'addAdmin']);
    Route::get('adminupdate',[AdminController::class,'edit']);
    Route::post('adminupdate',[AdminController::class,'update']);
    Route::get('deleteadmin/{id}',[AdminController::class,'delete']);
    Route::get('tournamentlogin',[TournamentController::class,'index']);
    Route::post('tournamentlogin',[TournamentController::class,'login']);
    Route::get('tournamentdash',[TournamentController::class,'tournamentDash'])->name('tournamentdash');
    Route::post('addtournament',[TournamentController::class,'add']);
    Route::post('updatetournament',[TournamentController::class,'update']);
    Route::get('deletetournament/{id}',[TournamentController::class,'delete']);

    Route::post('addgame',[GameNameController::class,'add']);
    Route::post('updategame',[GameNameController::class,'update']);
    Route::post('deletegame/{id}',[GameNameController::class,'delete']);
 });


 Route::prefix('team')->group(function(){
    Route::post('register',[TeamNameController::class,'register']);
    Route::post('add-member',[TeamMemberInfoController::class,'add_member']);
 });



