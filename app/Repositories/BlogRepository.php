<?php
namespace App\Repositories;
use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;
use Illuminate\Support\Facades\File;

class BlogRepository implements BlogRepositoryInterface{
    public function allBLog($model,$pages){
        return $model->paginate($pages);
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
  
      public function storeBlog($request,$user,$type,$status){
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
          $blog->user=$type;
  
          $blog->status=$status;
          
          $user->blog()->save($blog);
      }
  
      public function updateBlog($request,$id){
        $post=$this->blog($id);
        $imagePath=$post->image;
        $videoPath=$post->video;
        
        $post->title=$request->title;
        $post->description=$request->description;
  
        $header=substr($request->title,0,3).substr($request->description,0,4);
        if($request->hasFile('image')){
          $file=$request->file('image');
          $this->deleteFile($imagePath);
          $pathI=$file->storeAs('images',"custom_{$header}.jpg",['disk'=>'user_files']);
          $post->image=$pathI;
        }
        if($request->hasFile('video')){
          $file=$request->file('video');
          $this->deleteFile($videoPath);
          $pathV=$file->storeAs('videos',"custom_{$header}.mp4",['disk'=>'user_files']);
          $post->video=$pathV;
        }
        $post->save();
      }

      public function allClientBlog($page)
      {
        return Blog::where('status','approved')->paginate($page);
      }
}