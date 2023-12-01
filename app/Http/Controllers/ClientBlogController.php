<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\PostRequest;
use App\Models\Admin;
use App\Models\Auth;
use App\Models\Blog;
use App\Models\ImportantData;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientBlogController extends Controller
{
    
    public function login(){
        return view('Blog.Client.login');
    }
    
    public function signUp(){
        return view('Blog.Client.signUp');
    }
    
    
    public function authLogin(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:auths,email',
            'password'=>'required|'
        ]);
        $email=$request->email;
        $password=$request->password;
        $user = Auth::where('email', $email)->where('password', $password)->first();
    
        if($user){
            $request->session()->put('email',$email);
            $admin = Admin::where('email', $email)->where('password', $password)->first();
            if($admin){
            $request->session()->put('admin',$email);
            }
        }
        return redirect('/blog');
    }
    
    public function authSave(AuthRequest $request){
        $auth=Auth::create([
           'email'=>$request->email,
           'password'=>$request->password
        ]);
        return redirect('/login');
    }
    
    public function logout(Request $request){
        $request->session()->forget('email');
        $request->session()->forget('admin');
        return redirect('/blog');
    }

    public function moreBlog(){
        $data=Blog::paginate(4);
        return view('Blog.Client.moreBlog',compact('data'));
    }

    public function newBlog(){
        return view('Blog.Client.newBlog');
    }
    
    public function errorPage(){
        return view('Blog.Client.errorPage');
    }
    
    public function posts(Request $request){
        $email=$request->session()->get('email');
        $user=Auth::where('email',$email)->first();
        $data=$user->blog;
        return view('Blog.Client.post',compact('data'));
    }

}
