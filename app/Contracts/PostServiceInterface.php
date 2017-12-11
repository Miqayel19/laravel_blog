<?php
namespace App\Contracts;

interface PostServiceInterface {
    public function all();
    public function create($inputs);
    public function update($inputs, $id);
    public function delete($id);
    public function getById($id);
    public function getByAuthorId($id,$relation);
}