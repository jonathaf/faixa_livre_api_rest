<?php

/*use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
*/

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TrackController;


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

Route::get('/', function(){
    return response()->json(['Message' => 'API Rest Faixa Livre', 'status' => 'Connected']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function (){
    
    
    Route::apiResource('albums', AlbumController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('tracks', TrackController::class);

    Route::post('/favorites/album/',[AlbumController::class, 'addFavorite']);
    Route::delete('/favorites/album/{id}',[AlbumController::class, 'removeFavorite']);

    Route::post('/favorites/track/',[TrackController::class, 'addFavorite']);
    Route::delete('/favorites/track/{id}',[TrackController::class, 'removeFavorite']);
    
    Route::get('/favorites/albums',[AlbumController::class, 'favorites']);
    Route::get('/favorites/tracks',[TrackController::class, 'favorites']);
    

});