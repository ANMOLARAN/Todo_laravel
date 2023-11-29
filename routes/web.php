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
use App\Http\Middleware\AdminBlog;
use GuzzleHttp\Client;

// Route::get('/admin',[BlogController::class,'admin']);
// Route::post('/uploadVideo',[BlogController::class,'uploadVideo'])->name('video.uploadVideo');
// Route::post('/importantData',[BlogController::class,'importantData']);

Route::get('/blog',[ClientBlogController::class,'blog']);

//For ClientBlog Controller
Route::get('/login',[ClientBlogController::class,'login']);
Route::get('/signUp',[ClientBlogController::class,'signUp']);
Route::post('auth/login',[ClientBlogController::class,'authLogin']);
Route::post('auth/save',[ClientBlogController::class,'authSave']);
Route::get('/logout',[ClientBlogController::class,'logout']);
Route::get('/client/errorPage',[ClientBlogController::class,'errorPage']);

//For AdminBlogController

Route::middleware(['adminBlog','authBlog'])->group(function(){
    Route::get('/blog/admin',[AdminBlogController::class,'admin']);
    Route::post('/uploadVideo',[AdminBlogController::class,'uploadVideo'])->name('admin.uploadVideo');
    Route::get('/admin/blogData',[AdminBlogController::class,'blogData']);
    Route::post('/importantData',[AdminBlogController::class,'importantData']);
    Route::get('/admin/allAdmin',[AdminBlogController::class,'allAdmin']);
    Route::post('/auth/saveAdmin',[AdminBlogController::class,'saveAdmin']);
    Route::get('/newAdmin',function(){
     return view('Blog.Admin.newAdmin');
    });
    Route::get('/admin/deleteAdmin/{id}',[AdminBlogController::class,'deleteAdmin']);
    Route::get('/admin/allPost',[AdminBlogController::class,'allPost']);
    Route::get('/admin/approve/{id}',[AdminBlogController::class,'approve']);
    Route::get('admin/delete/{id}',[AdminBlogController::class,'deletePost']);

});
Route::get('/admin/errorPage',[AdminBlogController::class,'errorPage']);


//For ClientBlog Controller

Route::middleware(['authBlog'])->group(function(){
    Route::get('/client/detailBlog/{id}',[ClientBlogController::class,'detailBlog']);
    Route::get('client/posts',[ClientBlogController::class,'posts']);
    Route::get('client/newPost',[ClientBlogController::class,'newPost']);
    Route::post('/client/uploadVideo',[ClientBlogController::class,'uploadVideo'])->name('client.uploadVideo');
    Route::get('/client/detailPost/{id}',[ClientBlogController::class,'detailPost']);
    Route::get('/client/editPost/{id}',[ClientBlogController::class,'editPost']);
    Route::post('/client/updatePost/{id}',[ClientBlogController::class,'updatePost']);
    Route::get('/client/moreBlog',[ClientBlogController::class,'moreBlog']);
});



//resource
