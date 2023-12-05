<?php

namespace App\Http\Controllers;

use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\BlogRepositoryInterface;
use App\Models\Auth;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ResourceAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository){
        $this->blogRepository=$blogRepository;
     }

    public function index()
    {
        $blog=new Blog();
        $data=$this->blogRepository->allBlog($blog,10);
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
        $this->blogRepository->storeBlog($request,$user,'admin','approved');
        return redirect()->route('admin');    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data=$this->blogRepository->blog($id);
        return view('Blog.Admin.detailBlog',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=$this->blogRepository->blog($id);
        return view('Blog.Admin.editPost',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $this->blogRepository->updateBlog($request,$id);       
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
       $this->blogRepository->deleteFile($imagePath);
       $this->blogRepository->deleteFile($videoPath);
       $this->blogRepository->deleteBlog($id);
        return redirect()->route('admin');
    }
}
