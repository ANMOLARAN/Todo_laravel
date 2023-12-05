<?php

namespace App\Http\Controllers;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Auth;
use App\Models\Blog;
use App\Models\ImportantData;
use App\Trait\APIResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientBlog extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use APIResponse;
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
      $this->blogRepository=$blogRepository;
    }

    public function index()
    {   
        $model=new Blog();
        $data=$this->blogRepository->allClientBlog(3);
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
        $this->blogRepository->storeBlog($request,$user,'user','pending');

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
     $this->blogRepository->updateBlog($request,$id);
       
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
