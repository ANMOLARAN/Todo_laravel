<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    //

    public function cookie(){
        return view('Cookie.cookie');
    }

    public function setCookie(Request $request){
         $minutes=7*24*60;
         $response=new Response("Hello World");
         $value=$request->cookie;
         $cookie=cookie('cookie',$value,$minutes);
         $response->withCookie($cookie);
         return $response;
    }
}
