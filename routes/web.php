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
                 //TODO
//for session 
 use App\Http\Controllers\SessionController;

Route::get('/session',[SessionController::class,'session']);
Route::post('session/todoSession',[SessionController::class,'todoSession']);
Route::get('session/doneSession/{item}',[SessionController::class,'doneSession']);
Route::get('session/delete/{item}',[SessionController::class,'delete']);

//for Database Controller
use App\Http\Controllers\DatabaseController;

Route::get('database',[DatabaseController::class,'database']);
Route::post('database/storeSession',[DatabaseController::class,'storeSession']);
Route::get('database/doneSession/{item}',[DatabaseController::class,'doneSession']);
Route::get('database/delete/{item}',[DatabaseController::class,'delete']);
 
                   //BLOG FORUM
//For BLog Controller
use App\Http\Controllers\BlogController;
Route::get('/blog',[BlogController::class,'blog']);
Route::get('/admin',[BlogController::class,'admin']);
Route::post('/uploadVideo',[BlogController::class,'uploadVideo'])->name('video.uploadVideo');
Route::get('/detailBlog/{id}',[BlogController::class,'detailBlog']);
Route::get('/blogData',[BlogController::class,'blogData']);

Route::post('/importantData',[BlogController::class,'importantData']);