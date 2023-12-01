<?php

namespace App\Http\Controllers;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminResource extends Controller
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
        $admin=new Admin();
        $data=$this->adminRepository->allBlog($admin);
        return view('Blog.Admin.allAdmin',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Blog.Admin.newAdmin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ]);

        Admin::create([
            'email'=>$request->email,
            'password'=>$request->password
        ]);
       
        return redirect()->route('admin.allAdmin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::where('id',$id)->first()->delete();
        return redirect('/admin/allAdmin');
    }
}
