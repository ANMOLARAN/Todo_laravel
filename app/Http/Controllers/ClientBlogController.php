<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\PostRequest;
use App\Models\Admin;
use App\Models\Auth;
use App\Models\ImportantData;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        $data=Video::paginate(4);
        // $data=$this->success($data,200); 
        $temp=[];
        $value=ImportantData::all();
          foreach($value as $item){
          $temp[]=Video::find($item['value']);
        }   
        
        return view('Blog.Client.blog',compact('data','temp'));
    }
    
    public function moreBlog(){
        $data=Video::paginate(4);
        return view('Blog.Client.moreBlog',compact('data'));
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

    public function uploadVideo(PostRequest $request){
        
        $email=$request->session()->get('email');
        $user=Auth::where('email',$email)->first();
        $title=$request->title;
        $post=new Post();
        $post->title=$title;
        $post->description=$request->description;
         $header=substr($title,0,3).substr($title,5,8);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $pathI=$file->storeAs('images',"custom_{$header}.jpg",['disk'=>'user_files']);
            $post->image=$pathI;
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $pathV = $file->storeAs('videos', "custom_{$header}.mp4", ['disk' => 'user_files']);
            $post->video=$pathV;
        }
        
        $user->post()->save($post);

        return redirect('/client/posts');
    }

    public function posts(Request $request){
        $email=$request->session()->get('email');
        $user=Auth::where('email',$email)->first();
        $data=$user->post;
        return view('Blog.Client.post',compact('data'));
    }

    public function newPost(){
        return view('Blog.Client.blogU');
    }
  
    public function detailPost($id){
        $data=Post::find($id);
        return view('Blog.Client.detailPost',compact('data'));
    }

    public function editPost($id){
       $data=Post::find($id);
       return view('Blog.Client.editPost',compact('data'));
        
    }

    public function updatePost(Request $request,$id){
      $post=Post::find($id);
      $imagePath=$post->image;
      $videoPath=$post->video;
      
      $post->title=$request->title;
      $post->description=$request->description;

      $header=substr($request->title,0,3).substr($request->title,5,8);
      if($request->hasFile('image')){
        $file=$request->file('image');
        $pathI=$file->storeAs('images',"custom_{$header}.jpg",['disk'=>'user_files']);
        $originalFilePathI=public_path('user/'.$imagePath);
        File::delete($originalFilePathI);
        $post->image=$pathI;
      }
      if($request->hasFile('video')){
        $file=$request->file('video');
        $pathV=$file->storeAs('videos',"custom_{$header}.mp4",['disk'=>'user_files']);
        $originalFilePathV=public_path('user/'.$videoPath);
        File::delete($originalFilePathV);
        $post->video=$pathV;
      }
      $post->save();
       
      return redirect('/client/posts');
    }

    public function errorPage(){
        return view('Blog.Client.errorPage');
    }
}
