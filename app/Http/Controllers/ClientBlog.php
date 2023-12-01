<?php

namespace App\Http\Controllers;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Auth;
use App\Models\Blog;
use App\Models\ImportantData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientBlog extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
      $this->blogRepository=$blogRepository;
    }

    public function index()
    {
        $data=$this->blogRepository->allBlog();
        $temp=[];
        $value=ImportantData::all();
          foreach($value as $item){
          $temp[]=Blog::find($item['value']);
        }   
        
        return view('Blog.Client.blog',compact('data','temp'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    return view('Blog.Client.newBlog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $email=$request->session()->get('email');
        $user=Auth::where('email',$email)->first(); 
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

        $blog->user='user';

        $blog->status='pending';
        
        $user->blog()->save($blog);

        return redirect()->route('blog');    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data=$this->blogRepository->blog($id);
        return view('Blog.Client.detailBlog',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data=$this->blogRepository->blog($id);
        return view('Blog.Client.editPost',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $post=$this->blogRepository->blog($id);
      $imagePath=$post->image;
      $videoPath=$post->video;
      
      $post->title=$request->title;
      $post->description=$request->description;

      $header=substr($request->title,0,3).substr($request->description,0,4);
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
       
      return redirect()->route('client.post');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $blog=$this->blogRepository->blog($id);
        $imagePath=$blog->image;
        $videoPath=$blog->video;
        $this->blogRepository->deleteFile($imagePath);
        $this->blogRepository->deleteFile($videoPath);
        $this->blogRepository->deleteBlog($id);
         return redirect()->route('client.post');
    }
}
