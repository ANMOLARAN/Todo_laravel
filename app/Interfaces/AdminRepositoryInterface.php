<?php
namespace App\Interfaces;

interface AdminRepositoryInterface{
    public function allBlog($model);
    public function Blog($id);
    public function deleteBlog($id);
    public function deleteFile($item);
    public function storeBlog($request,$user);
}