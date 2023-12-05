<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AdminResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceAdminController;
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
use App\Http\Controllers\ClientBlog;
use App\Http\Controllers\ClientBlogController;
use App\Http\Middleware\AdminBlog;




//For ClientBlog Controller
Route::get('/login',[ClientBlogController::class,'login']);
Route::get('/signUp',[ClientBlogController::class,'signUp']);
Route::post('auth/login',[ClientBlogController::class,'authLogin']);
Route::post('auth/save',[ClientBlogController::class,'authSave']);
Route::get('/logout',[ClientBlogController::class,'logout']);
Route::get('/client/errorPage',[ClientBlogController::class,'errorPage']);

//For AdminBlogController


Route::middleware(['adminBlog','authBlog'])->group(function(){
    Route::get('/admin',[ResourceAdminController::class,'index'])->name('admin');
    Route::get('/admin/newBlog',[ResourceAdminController::class,'create'])->name('admin.newBlog');
    Route::post('/admin/storeBlog',[ResourceAdminController::class,'store'])->name('admin.storeBlog');
    Route::get('/admin/showBlog/{id}',[ResourceAdminController::class,'show'])->name('admin.showBlog');
    Route::get('/admin/edit/{id}',[ResourceAdminController::class,'edit'])->name('admin.editBlog');
    Route::put('/admin/updatePost/{id}',[ResourceAdminController::class,'update'])->name('admin.update');
    Route::delete('/admin/deleteBlog/{id}',[ResourceAdminController::class,'destroy'])->name('admin.delete');
    Route::get('/admin/allAdmin',[AdminResource::class,'index'])->name('admin.allAdmin');
    Route::get('/admin/newAdmin',[AdminResource::class,'create'])->name('admin.newAdmin');
    Route::delete('/admin/deleteAdmin/{id}',[AdminResource::class,'destroy'])->name('admin.deleteAdmin');
    Route::post('/admin/storeAdmin',[AdminResource::class,'store'])->name('admin.storeAdmin');
    Route::get('/admin/change/{id}',[AdminBlogController::class,'approve'])->name('admin.change');
    Route::post('/admin/importantData',[AdminBlogController::class,'importantData'])->name('admin.importantData');
    Route::get('/admin/allUser',[AdminBlogController::class,'allUser'])->name('admin.allUser');
    
});
Route::get('/admin/errorPage',[AdminBlogController::class,'errorPage']);


//For ClientBlog Controller

   Route::middleware(['authBlog'])->group(function(){
       Route::get('/client/posts',[ClientBlogController::class,'posts'])->name('client.post');

      Route::get('/client/moreBlog',[ClientBlogController::class,'moreBlog'])->name('client.moreBlog');
   });
Route::get('/blog',[ClientBlog::class,'index'])->name('blog');
Route::middleware(['authBlog'])->group(function(){
    Route::get('/client/newBlog',[ClientBlog::class,'create'])->name('client.newBlog');
    Route::post('/client/storeBlog',[ClientBlog::class,'store'])->name('client.storeBlog');
    Route::get('/client/showBlog/{id}',[ClientBlog::class,'show'])->name('client.showBlog');
    Route::delete('/client/delete/{id}',[ClientBlog::class,'destroy'])->name('client.delete');
    Route::get('/client/edit/{id}',[ClientBlog::class,'edit'])->name('client.editBlog');
    Route::put('/client/updatePost/{id}',[ClientBlog::class,'update'])->name('client.update');
});
Route::get('/client/forgetPassword',[ClientBlogController::class,'forgetPassword'])->name('client.forgetPassword');
Route::post('/client/enterEmail',[ClientBlogController::class,'enterEmail'])->name('client.enterEmail');
Route::get('/client/resetPassword/{email}/{token}',[ClientBlogController::class,'resetPassword'])->name('client.resetPassword');
Route::post('/client/updatePassword/{email}',[ClientBlogController::class,'updatePassword'])->name('client.updatePassword');




