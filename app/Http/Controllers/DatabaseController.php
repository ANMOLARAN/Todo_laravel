<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Todo;
use App\Models\Done;

class DatabaseController extends Controller
{
    //
    public function database(){
        $todo=Todo::pluck('todo');
        $done=Done::pluck('done');
        return view('Database.database',compact('todo','done'));
    }

    public function storeSession(Request $request){
       $value=$request->input('session');
       $todo=new Todo([
        'todo'=>$value
       ]);
       $todo->save();
       return  redirect('/database');
    }

    public  function doneSession(Request $request,$item){
        $this->deleteSession($item);
        $done=new Done([
            'done'=>$item
        ]);
        $done->save();
        return redirect('/database');
    }
 
    public function delete($item){
        $this->deleteSession($item);
        return redirect('/database');
    }

    public function deleteSession($item){
         Todo::where('todo',$item)->delete();
         Done::where('done',$item)->delete();
    }
}
