<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Auth;
use App\Models\ImportantData;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;

class ClientBlogController extends Controller
{
    
//     public function blog(){

//         $data=Video::all();
//         // $data=$this->success($data,200); 
//         $temp=[];
//         $value=ImportantData::all();
//           foreach($value as $item){
//           $temp[]=Video::find($item['value']);
//         }    
//         $responseData = [
//          'videos' => $data,
//          'importantData' => $temp,
// ];
//         $value=$this->success($responseData,200); 
//         dd((json_decode($value->content()))->data->importantData);
         
        
//         return view('Blog.Client.blog',compact('data','temp'));
//     }

    public function blog(){

        $data=Video::all();
        // $data=$this->success($data,200); 
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
            $admin = Admin::where('email', $email)->where('password', $password)->first();
            if($admin){
            $request->session()->put('admin',$email);
            }
        }
        return redirect('/blog');
    }

    public function authSave(Request $request){
        $request->validate([
            'email'=> 'required|email|unique:auths,email',
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

    public function uploadVideo(Request $request){
        // $this->validate($request, [
        //     'title' => 'required|string|min:8',
        //     'description'=>'required|string|min:50',
        //     'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
        //     'video' => 'required|file|mimetypes:video/mp4',
        // ]);

        dd($request);
        
        $title=$request->title;
        $post=new Post();
        $post->title=$title;
        $post->description=$request->description;
        $header=substr($title,0,3).substr($title,5,8);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $pathI=$file->storeAs('images',"custom_{$header}.jpg",['disk'=>'my_files']);
            $post->image=$pathI;
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $pathV = $file->storeAs('videos', "custom_{$header}.mp4", ['disk' => 'my_files']);
            $post->video=$pathV;
        }
        
        $post->save();

        return redirect('/admin');
    }

    public function posts(){
        return view('Blog.Client.post');
    }

    public function newPost(){
        return view('Blog.Client.blogU');
    }


}
