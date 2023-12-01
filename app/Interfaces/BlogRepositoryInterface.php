<?php
namespace App\Interfaces;

interface BlogRepositoryInterface{
    public function allBlog();
    public function Blog($id);
    public function deleteBlog($id);
    public function deleteFile($item);
}