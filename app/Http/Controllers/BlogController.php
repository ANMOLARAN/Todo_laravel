<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function blog($data1=null,$data2=null,$data3=null,$data4=null){
        $data=Video::all();

        if($data1==null){
            $data1=$data[0];
            $data2=$data[1];
            $data3=$data[2];
            $data4=$data[3];
        }
        else{
            $data1 = Video::find($data1);
            $data2 = Video::find($data2);
            $data3 = Video::find($data3);
            $data4 = Video::find($data4);
        }
        
        return view('Blog.Client.blog',compact('data','data1','data2','data3','data4'));
    }

    public function admin(){
        return view('Blog.Admin.blogU');
    }

    public function uploadVideo(Request $request){
        $this->validate($request, [
            'title' => 'required|string|min:8',
            'description'=>'required|string|min:50',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'video' => 'required|file|mimetypes:video/mp4',
        ]);
        
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

    public function detailBlog(Request $request,$id){
        $data=Video::find($id);
        return view('Blog.Client.detailBlog',compact('data'));
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
       
      return $this->blog($data1,$data2,$data3,$data4);
    }
}
