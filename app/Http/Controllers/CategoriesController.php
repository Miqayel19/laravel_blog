<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Auth;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        return view('categories.index');   
    }
    public function create()
    {
        return view('categories.add');
    }
    public function store(Request $request)
    {
        $added_category = Category::create(['title' => $request->input('title'),'user_id' => Auth::id()]);
        $result = Category::where('user_id',Auth::id())->get(); 
        if($result)
        {
            return redirect('/categories')->with('msg','Category added successfully');
        } 
        return redirect()->back()->with('msg','Category not added,try again');
    }  
    public function destroy($id)
    {   
        $deleted_category = Category::where('id', $id)->delete();
        if($deleted_category)
        {
            return redirect('/categories')->with('msg','Category deleted successfully');
        }  
        return redirect()->back()->with('msg','Category not deleted,try again');
        
    }    
    public function edit($id)
    {
        $result = Category::where('id',$id)->first();
        return view('categories.edit',['categories' => $result]);
    }
    public function update($id,Request $request)
    {
        $updated_category = Category::where('id', $id)->update(['title' => $request->input('title')]); 
        $result = Category::where('user_id',Auth::id())->get();
        if($result)
        {   
            return redirect('/categories')->with('msg','Category updated successfully');
        } 
        return redirect()->back()->with('msg','Category not updated,try again');
           
    }
    public function show($id)
    {
        $my_categories = Category::where('user_id',Auth::id())->get();
        $current_category = Category::find($id);
        $current_category_posts = Post::where('cat_id',$id)->orderby('id','desc')->paginate('3'); 
        return view('categories.show',['posts' => $current_category_posts]);           
    }
}
    