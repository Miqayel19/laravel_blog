<?php
namespace App\Services;

use App\Category;
use App\Contracts\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(Category $category)
    {
       $this->category = $category;
    }
    public function all()
    {   
        return $this->category->get();
    }
    public function create($inputs)
    {   
        return $this->category->create($inputs);
    }
    public function update($inputs, $id)
    {
        return $this->category->where('id', $id)->update($inputs);
    }
    public function getById($id)
    {
        return $this->category->find($id);
    }
    public function delete($id)
    {
        return $this->category->where('id', $id)->delete();
    }
    public function getByAuthorId($id)
    {
        return $this->category->where('user_id', $id)->get();
    }
}   
?>