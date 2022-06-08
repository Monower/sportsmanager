<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */

 //public routes
 Route::get('adminlogin',[AdminLogin::class,'login']);
 Route::post('adminlogin',[AdminLogin::class,'protected_login']);

 //protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('addmanager',[AdminLogin::class,'registerManager']);
    Route::post('adminlogout',[AdminLogin::class,'logout']);
});



