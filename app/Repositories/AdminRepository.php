<?php
namespace App\Repositories;
use App\Interfaces\AdminRepositoryInterface;
use App\Models\Blog;
use Illuminate\Support\Facades\File;

class AdminRepository implements AdminRepositoryInterface{
    public function allBLog($model){
      return $model->paginate(10);
    }

    public function blog($id){
        return Blog::find($id);
    }

    public function deleteBlog($id){
        Blog::destroy($id);
    }

    public function deleteFile($item){
       $file=public_path('user/'.$item);
       if(File::exists($file)){
        File::delete($file);
       }
    }

    public function storeBlog($request,$user){
        $blog=new Blog();
        $title=$request->title;
        $blog->title=$title;
        $description=$request->description;
        $blog->description=$description;
        $header=substr($title,0,3).substr($description,0,4);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $pathI=$file->storeAs('images',"custom_{$header}.jpg",['disk'=>'user_files']);
            $blog->image=$pathI;
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $pathV = $file->storeAs('videos', "custom_{$header}.mp4", ['disk' => 'user_files']);
            $blog->video=$pathV;
        }
        $blog->user='admin';

        $blog->status='approved';
        
        $user->blog()->save($blog);
    }
}