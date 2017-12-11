<?php
namespace App\Services;

use App\Post;
use App\Contracts\PostServiceInterface;

class PostService implements PostServiceInterface
{
    public function __construct(Post $post)
    {
       $this->post = $post;
    }
    public function all()
    {   
        return $this->post->get();
    }
    public function create($inputs)
    {
        return $this->post->create($inputs);
    }
    public function update($inputs, $id)
    {
        return $this->post->where('id', $id)->update($inputs);
    }
    public function getById($id)
    {
        return $this->post->find($id);
    }
    public function delete($id)
    {
        return $this->post->where('id', $id)->delete();
    }
    public function getByAuthorId($id,$relation = null)
    {
        return !is_null($relation) ? $this->post->where('user_id',$id)->with($relation)->get() : $this->post->where('user_id',$id)->get();
    }
}        
?>