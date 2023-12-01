<?php

namespace App\Http\Controllers;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\Auth;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ResourceAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private AdminRepositoryInterface $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository){
        $this->adminRepository=$adminRepository;
     }

    public function index()
    {
        $blog=new Blog();
        $data=$this->adminRepository->allBlog($blog);
        return view('Blog.Admin.blogData',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Blog.Admin.newBlog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $email=$request->session()->get('email');
        $user=Auth::where('email',$email)->first(); 
        $this->adminRepository->storeBlog($request,$user);
        return redirect()->route('admin');    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data=$this->adminRepository->blog($id);
        return view('Blog.Admin.detailBlog',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Blog::find($id);
        return view('Blog.Admin.editPost',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $post=$this->adminRepository->blog($id);
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
       
      return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $blog=Blog::find($id);
       $imagePath=$blog->image;
       $videoPath=$blog->video;
       $this->adminRepository->deleteFile($imagePath);
       $this->adminRepository->deleteFile($videoPath);
       $this->adminRepository->deleteBlog($id);
        return redirect()->route('admin');
    }
}
