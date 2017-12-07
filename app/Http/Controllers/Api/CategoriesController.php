<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CategoryRequest;
use App\Contracts\CategoryServiceInterface;
use App\Category;
use App\User; 
use Auth;

class CategoriesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {      
        $categories = Category::get();
        return response()->json(['status' => 'success','message' => 'Get all categories','resource' => $categories], 200);  
    }
    public function mycategories(CategoryServiceInterface $categoryService)
    {      
        $categories = $categoryService->getCategoryByUser(Auth::id());
        return response()->json(['status' => 'success','message' => 'Getting My categories','resource' => $categories], 200);  
    }
    public function store(CategoryServiceInterface $categoryService,CategoryRequest $request)
    {    
        $inputs = $request->storeInputs();
        $category = $categoryService->addCategory($inputs);
        $result = $categoryService->getCategoryByUser(Auth::id());
        if($category){
            return response()->json(['status' => 'success','message' => 'Successfully added','resource' => $result], 200);
        } 
        return response()->json(['status' => 'error','message' => 'Category not added'],400);
    }
    public function edit($id,CategoryServiceInterface $categoryService)
    {    
        $category = $categoryService->editCategory($id);
        return response()->json(['status' => 'success','message' => 'Edited successfully','resource' => $category], 200);
    }
    public function update($id,CategoryServiceInterface $categoryService,CategoryRequest $request)
    {   
        $inputs = $request->updateInputs();
        $category = $categoryService->updateCategory($inputs, $id);
        $result = $categoryService->getCategoryByUser(Auth::id());
        if($category){
            return response()->json(['status' => 'success','message' => 'Category  updated!','resource' => $result], 200);
        } 
        return response()->json(['status' => 'success','message' => 'Category not updated!'],400);
    }
    public function destroy($id,CategoryServiceInterface $categoryService)
    {   
        $category = $categoryService->deleteCategory($id);
        $result = $categoryService->getCategoryByUser(Auth::id());
        if($category){
            return response()->json(['status' => 'success','message' => 'Category deleted!','resource' => $result], 200);
        } 
        return response()->json(['status' => 'error','message' => 'Category not deleted!'],400);
    }  
}    
