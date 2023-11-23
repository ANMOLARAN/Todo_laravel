<?php

namespace App\Trait;

Trait APIResponse{
    public function success($data,$code){
        $content=json_encode([
           'data'=>$data,
           'message'=>'Success'
        ]);
       return response($content,$code)->header('Content-Type', 'application/json');
    }

    public function error(){
        return 'Error is generated';
    }
}