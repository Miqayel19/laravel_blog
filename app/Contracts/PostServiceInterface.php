<?php
namespace App\Contracts;

interface PostServiceInterface {
    public function addPost($inputs);
    public function updatePost($inputs, $id);
    public function deletePost($id);
    public function editPost($id);
}