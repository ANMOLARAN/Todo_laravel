<?php
namespace App\Interfaces;

interface BlogRepositoryInterface{
    public function allBlog($model,$page);
    public function Blog($id);
    public function deleteBlog($id);
    public function deleteFile($item);
    public function storeBlog($request,$user,$type,$status);
    public function updateBlog($request,$id);
    public function allClientBlog($page);
}