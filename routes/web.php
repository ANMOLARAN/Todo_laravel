<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//for cookies
 use App\Http\Controllers\SessionController;

Route::get('/session',[SessionController::class,'session']);
Route::post('/todoSession',[SessionController::class,'todoSession']);
Route::get('/doneSession/{item}',[SessionController::class,'doneSession']);
Route::get('/delete/{item}',[SessionController::class,'delete']);


use App\Http\Controllers\DatabaseController;

Route::get('database',[DatabaseController::class,'database']);
Route::post('storeSession',[DatabaseController::class,'storeSession']);
Route::get('/doneSession/{item}',[DatabaseController::class,'doneSession']);
Route::get('/delete/{item}',[DatabaseController::class,'delete']);