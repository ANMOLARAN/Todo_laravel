<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Admin;
use App\Models\Auth;
use App\Models\ImportantData;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminBlogController extends Controller
{
    public function admin(){
        return view('Blog.Admin.blogU');
    }

    public function uploadVideo(PostRequest $request){
        
        $title=$request->title;
        $video=new Video();
        $video->title=$title;
        $description=$request->description;
        $video->description=$description;
        $header=substr($title,0,3).substr($title,5,8);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $pathI=$file->storeAs('images',"custom_{$header}.jpg",['disk'=>'my_files']);
            $video->image=$pathI;
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $pathV = $file->storeAs('videos', "custom_{$header}.mp4", ['disk' => 'my_files']);
            $video->video=$pathV;
        }
        
        $video->save();

        return redirect('/admin');
    }

    public function blogData(){
        $data=Video::all();
        return view('Blog.Admin.blogData',compact('data'));
    }

    public function importantData(Request $request){
        $data1=$request->value1;
        $data2=$request->value2;
        $data3=$request->value3;
        $data4=$request->value4;
 
        $value=[$data1,$data2,$data3,$data4];
        sort($value);
        for($it=1;$it<4;$it++){
           if($value[$it-1]==$value[$it]){
             return redirect('blogData');
           }
        }

        ImportantData::truncate();

    foreach($value as $data){
        ImportantData::create([
            'value'=>$data
        ]);
    }
        
       return redirect('/blog');
     }

     public function allAdmin(){
        $data=Admin::all();
        return view('Blog.Admin.allAdmin',compact('data'));
     }

     public function saveAdmin(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ]);

        Admin::create([
            'email'=>$request->email,
            'password'=>$request->password
        ]);
       
        return redirect('/admin/allAdmin');
     }

     public function deleteAdmin(Request $request,$id){
        Admin::where('id',$id)->first()->delete();
        return redirect('/admin/allAdmin');
     }

     public function allPost(Request $request){
        $data=Post::all();

        return view('Blog.Admin.allPost',compact('data'));
     }

     public function approve(Request $request,$id){
        $post=Post::find($id);
        $user=$post->auth;

        //to move file from public user to public image and video

        $originalFilePathI=public_path('user/'.$post->image);
        $originalFilePathV=public_path('user/'.$post->video);
        $destinationFolderI=public_path($post->image);
        $destinationFolderV=public_path($post->video);
        File::move($originalFilePathI,$destinationFolderI);
        File::move($originalFilePathV,$destinationFolderV);

        //To save in video table
        $video=Video::create([
            'title'=>$post->title,
            'description'=>$post->description,
            'image'=>$post->image,
            'video'=>$post->video
        ]);
        $video->save();
         
        $this->delete($post->id);

        return redirect('/admin/blogData');
     }

     public function deletePost($id){
        $this->delete($id);
        return redirect('/admin/allPost');
     }

     public function delete($id){
           return Post::where('id',$id)->first()->delete();
     }

     public function deletBlog($id){
        Video::where('id',$id)->first()->delete();
        
     }

     public function errorPage(){
        return view('Blog.Admin.errorPage');
    }
}
