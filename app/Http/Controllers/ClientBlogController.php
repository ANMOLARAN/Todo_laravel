<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\PostRequest;
use App\Interfaces\BlogRepositoryInterface;
use App\Mail\ForgetPassword;
use App\Models\Admin;
use App\Models\Auth;
use App\Models\Blog;
use App\Models\ImportantData;
use App\Models\Post;
use App\Models\ResetPassword;
use App\Models\Video;
use App\Trait\APIResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientBlogController extends Controller
{ 
    use APIResponse;
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository){
        $this->blogRepository=$blogRepository;
    }
    public function login(){
        return view('Blog.Client.login');
    }
    
    public function signUp(){
        return view('Blog.Client.signUp');
    }
    
    
    public function authLogin(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:auths,email',
            'password'=>'required|'
        ]);
        $email=$request->email;
        $password=$request->password;
        $user = Auth::where('email', $email)->where('password', $password)->first();
    
        if($user){
            $request->session()->put('email',$email);
            $admin = Admin::where('email', $email)->where('password', $password)->first();
            if($admin){
            $request->session()->put('admin',$email);
            }
        }
        return redirect('/blog');
    }
    
    public function authSave(AuthRequest $request){
        $auth=Auth::create([
           'email'=>$request->email,
           'password'=>$request->password
        ]);
        return redirect('/login');
    }
    
    public function logout(Request $request){
        $request->session()->forget('email');
        $request->session()->forget('admin');
        return redirect('/blog');
    }

    public function moreBlog(){
        //$data=$this->success($this->blogRepository->allClientBlog(4),200);
       $data=$this->blogRepository->allClientBlog(4);
        return view('Blog.Client.moreBlog',compact('data'));
    }

    public function newBlog(){
        return view('Blog.Client.newBlog');
    }
    
    public function errorPage(){
        return view('Blog.Client.errorPage');
    }
    
    public function posts(Request $request){
        $email=$request->session()->get('email');
        $user=Auth::where('email',$email)->first();
        $data=$user->blog;
        return view('Blog.Client.post',compact('data'));
    }

    public function forgetPassword(){
        return view('Blog.Client.forgetPassword');
    }

    public function enterEmail(Request $request){
        $email=$request->email;
        $token=random_int(0,50);
        $expiresAt=Carbon::now()->addHours(1);
        ResetPassword::create([
            'email'=>$email,
            'token'=>$token,
            'expires_at'=>$expiresAt
        ]);
        $mail=new ForgetPassword($email,$token);
        Mail::to($email)->send($mail);
        return view('Blog.Client.forgetPassword');
    }

    public function resetPassword(Request $request,$email,$token){

        $email = decrypt(urldecode($email));
        $token=decrypt($token);
        $resetEntry = DB::table('reset_passwords')
        ->where('email', $email)
        ->where('token', $token)
        ->where('expires_at', '>', now()) 
        ->first();

        if($resetEntry){
            return view('Blog.Client.enterPassword',['email'=>$email]);
        }
        return "Data alredy expired";
    }

    public function updatePassword(Request $request,$email){
        $email=decrypt($email);
       try{
        $user=Auth::where('email',$email)->first();
        $user->password=$request->password;
        $user->save();
        }
        catch(Exception $e){
            return $e;   
        }
        return view('Blog.Client.login');
    }

}
