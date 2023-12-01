<?php
namespace App\Repositories;
use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;
use Illuminate\Support\Facades\File;

class BlogRepository implements BlogRepositoryInterface{
    public function allBLog(){
      return Blog::where('status','approved')->paginate(4);
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
}