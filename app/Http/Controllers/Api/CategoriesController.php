<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CategoryRequest;
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
        return response()->json(['categories' => $categories], 200);  
    }
    public function mycategories()
    {      
        $categories = Category::where('user_id',Auth::id())->get();
        return response()->json(['mycategories' => $categories], 200);  
    }
    public function add(CategoryRequest $request)
    {    
        $inputs = $request->storeInputs();
        $added_category = Category::create(['title' => $inputs['title'],'user_id' => Auth::id()]);
        $result = Category::where('user_id',Auth::id())->get();
        if($result)
        {
            return response()->json(['mycategories' => $result], 200);
        } 
        return response()->json(['error' => 'Category not added!'],400);
    }
    public function edit($id)
    {    
        $category = Category::where('id',$id)->first();
        return response()->json(['mycategory' => $category], 200);
    }
    public function update($id,CategoryRequest $request)
    {   
        $inputs = $request->updateInputs();
        $updated_category = Category::where('id', $id)->update(['title' => $inputs['name']]); 
        $result = Category::where('user_id',Auth::id())->get();
        if($result)
        {
            return response()->json(['mycategories' => $result], 200);
        } 
        return response()->json(['error' => 'Category not updated!'],400);
    }
    public function destroy($id)
    {   
        $deleted_category = Category::where('id', $id)->delete();
        $result = Category::where('user_id',Auth::id())->get();
        if($result)
        {
            return response()->json(['mycategories' => $result], 200);
        } 
        return response()->json(['error' => 'Category not deleted!'],400);
    }  
}    
