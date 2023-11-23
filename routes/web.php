<?php

use App\Http\Controllers\AdminBlogController;
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
use App\Http\Controllers\ClientBlogController;

// Route::get('/admin',[BlogController::class,'admin']);
// Route::post('/uploadVideo',[BlogController::class,'uploadVideo'])->name('video.uploadVideo');
//Route::post('/importantData',[BlogController::class,'importantData']);

Route::get('/blog',[ClientBlogController::class,'blog']);
Route::get('/detailBlog/{id}',[ClientBlogController::class,'detailBlog'])->middleware('authBlog');

//For ClientBlog Controller
Route::get('/login',[ClientBlogController::class,'login']);
Route::get('/signUp',[ClientBlogController::class,'signUp']);
Route::post('auth/login',[ClientBlogController::class,'authLogin']);
Route::post('auth/save',[ClientBlogController::class,'authSave']);


//For AdminBlogController
Route::middleware(['adminBlog','authBlog'])->group(function(){
    Route::get('/blog/admin',[AdminBlogController::class,'admin']);
    Route::post('/uploadVideo',[AdminBlogController::class,'uploadVideo'])->name('admin.uploadVideo');
    Route::get('/blogData',[AdminBlogController::class,'blogData']);
    Route::post('/importantData',[AdminBlogController::class,'importantData']);
    Route::get('/allAdmin',[AdminBlogController::class,'allAdmin']);
    Route::post('/auth/saveAdmin',[AdminBlogController::class,'saveAdmin']);
    Route::get('/newAdmin',function(){
     return view('Blog.Admin.newAdmin');
    });
    Route::get('deleteAdmin/{id}',[AdminBlogController::class,'deleteAdmin']);

});

Route::get('/logout',[ClientBlogController::class,'logout']);

Route::post('/uploadVideo',[ClientBlogController::class,'uploadVideo'])->name('client.uploadVideo');

Route::get('client/posts',[ClientBlogController::class,'posts']);
Route::get('client/newPost',[ClientBlogController::class,'newPost']);