<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Auth;
use App\Models\ImportantData;
use App\Models\Video;
use Illuminate\Http\Request;

class ClientBlogController extends Controller
{
    
    public function blog(){
        $data=Video::all();

        $data=Video::all();
        $temp=[];
        $value=ImportantData::all();

        foreach($value as $item){
          $temp[]=Video::find($item['value']);
        }    
        
        return view('Blog.Client.blog',compact('data','temp'));
    }


    public function detailBlog(Request $request,$id){
        $data=Video::find($id);
        return view('Blog.Client.detailBlog',compact('data'));
    }

    public function login(){
        return view('Blog.Client.login');
    }

    public function signUp(){
        return view('Blog.Client.signUp');
    }


    public function authLogin(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ]);
        $email=$request->email;
        $password=$request->password;
        $user = Auth::where('email', $email)->where('password', $password)->first();

        if($user){
            $request->session()->put('email',$email);
            $id=$user->id;
            $admin=Admin::where('user_id',$id)->first();
            if($admin){
            $request->session()->put('admin',$email);
            }
        }
        return redirect('/blog');

    }

    public function authSave(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ]);
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


}
