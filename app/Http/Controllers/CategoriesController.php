<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
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
    public function index(Category $category)
    {      
        $my_categories = $category->where('user_id',Auth::id())->get();
        $categories = $category->get();
        return view('category',['categories'=>$categories, 'my_categories'=>$my_categories,]);   
    }
    
    public function create()
    {
        return view('add_category');
    }
    public function store(Request $request,Category $category)
    {
        $category->create(['title' => $request->input('title'),'user_id'=>Auth::id()]);
        $categories = $category->get();
        $my_categories = $category->where('user_id',Auth::id())->get();
        return redirect('/categories');
    }


    public function destroy($id, Category $category)
    {   
        $category->where('id', $id)->delete();
        return redirect('/categories');
    }
    public function edit($id, Category $category)
    {
        $categories=$category->where('id',$id)->first();
        return view('edit_category',['categories'=>$categories]);
    }

    public function update($id, Request $request, Category $category)
    {
        $category
            ->where('id', $id)
            ->update(['title' => $request->input('title')]);
        $my_categories =$category->where('user_id',Auth::id())->get();
        $categories = $category->get();
        return view('category',['categories'=>$categories,'my_categories'=>$my_categories]);
    }
}