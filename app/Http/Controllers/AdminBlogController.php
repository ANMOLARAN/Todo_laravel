<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Admin;
use App\Models\Auth;
use App\Models\Blog;
use App\Models\ImportantData;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminBlogController extends Controller
{
    public function allUser(){
        $data=Auth::all();
        return view('Blog.Admin.allUser',compact('data'));
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

     public function approve($id){
        $post=Blog::find($id);
        $value=$post->status;
        if($value=='approved'){
            $post->status='pending';
        }
        else{
            $post->status='approved';
        }
       $post->save();
 
        return redirect()->route('admin');
     }
     
    public function errorPage(){
        return view('Blog.Admin.errorPage');
    }
}
