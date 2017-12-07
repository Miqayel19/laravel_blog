<?php
namespace App\Contracts;

interface CategoryServiceInterface {
    public function addCategory($inputs);
    public function updateCategory($inputs, $id);
    public function deleteCategory($id);
    public function editCategory($id);
    public function getCategoryByUser($id);
}