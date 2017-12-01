<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Requests\CategoryRequest;
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
        $added_category = $request->categoryStore();
        return response()->json(['mycategories' => $added_category], 200);
    }
    public function edit($id)
    {    
        $categories = Category::where('id',$id)->first();
        return response()->json(['mycategories' => $categories], 200);
    }
    public function update($id,CategoryRequest $request)
    {   
        $updated_category = $request->categoryUpdate($id);
        return response()->json(['mycategories' => $updated_category], 200);
    }
    public function destroy($id)
    {   
        $result = Category::where('id', $id)->delete();
        $categories = Category::where('user_id',Auth::id())->get();
        return response()->json(['mycategories' => $categories], 200);
    }
    public function show($id)
    {
        $my_categories = Category::where('user_id',Auth::id())->get();
        $current_category = Category::find($id);
        $current_category_posts = Post::where('cat_id',$id)->orderby('id','desc')->Paginate('3'); 
        return response()->json(['posts' => $current_category_posts],200);           
    }
    
}    
