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
        $info = $request->categoryStore();
        $added_category = Category::create(['title' => $info['title'],'user_id' => Auth::id()]);
        $result = Category::where('user_id',Auth::id())->get();
        return response()->json(['mycategories' => $result], 200);
    }
    public function edit($id)
    {    
        $categories = Category::where('id',$id)->first();
        return response()->json(['mycategories' => $categories], 200);
    }
    public function update($id,CategoryRequest $request)
    {   
        $info = $request->categoryUpdate();
        $updated_category = Category::where('id', $id)->update(['title' => $info['name']]); 
        $result = Category::where('user_id',Auth::id())->get();
        return response()->json(['mycategories' => $result], 200);
    }
    public function destroy($id)
    {   
        $result = Category::where('id', $id)->delete();
        $categories = Category::where('user_id',Auth::id())->get();
        return response()->json(['mycategories' => $categories], 200);
    }  
}    
