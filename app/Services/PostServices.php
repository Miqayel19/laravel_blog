<?php
namespace App\Services;

use App\Post;
use App\Contracts\PostServiceInterface;

class PostServices implements PostServiceInterface
{
    public function __construct(Post $post)
    {
       $this->post = $post;
    }
    public function addPost($inputs)
    {
        return $this->post->create($inputs);
    }
    public function updatePost($inputs, $id)
    {
        return $this->post->where('id', $id)->update($inputs);
    }
    public function editPost($id)
    {
        return $this->post->find($id);
    }
    public function deletePost($id)
    {
        return $this->post->where('id', $id)->delete();
    }
    public function getpostByCategory($id)
    {
        return $this->post->where('user_id', $id)->get();
    }
}   
?>