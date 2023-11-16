<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function session(Request $request){
        $todo=$request->session()->get('todo',[]);
        $done=$request->session()->get('done',[]);
        return view('Session.session',compact('todo','done')); 
    }

    public function todoSession(Request $request){
        $value = $request->input('session');
        $data=$request->session()->get('todo',[]);
        if (!is_array($data)) {
            $data = [];
        }    
        $data[]=$value;
        $request->session()->put('todo',$data);
        return redirect('/session');
    }

    public function doneSession(Request $request,$item){
      $data1=$request->session()->get('done',[]);
      //call the delete Method
      $this->deleteTodo($request,$item);

      if(!is_array($data1)){
       $data1=[];
      }
      $data1[]=$item;
      $request->session()->put('done',$data1);
      return redirect('/session');
    }

    public function delete($item){
    $this->deleteTodo(request(),$item);
    return redirect('/session');
    }


    public function deleteTodo(Request $request,$item){

        //for deleting TODO items
        $data=$request->session()->get('todo',[]);
        $data1=[];
        foreach($data as $value){
           if($value==$item) continue;
           $data1[]=$value;
        }
        $request->session()->put('todo',$data1);
       
        //for deleteing DONE items
        $data=$request->session()->get('done',[]);
        $data1=[];
        foreach($data as $value){
           if($value==$item) continue;
           $data1[]=$value;
        }
        $request->session()->put('done',$data1);
      }


    
}
