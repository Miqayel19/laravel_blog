<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Contracts\CategoryServiceInterface;
use Illuminate\Http\Request;
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
        return view('categories.create');
    }
    public function store(CategoryServiceInterface $categoryService,Request $request)
    {
        $inputs = ['title' => $request->input('title'),'user_id' => Auth::id()];
        $category = $categoryService->create($inputs);
        if($category){
            return redirect('/categories')->with('message','Category added successfully');
        } 
        return redirect()->back()->with('error','Category not added,try again');
    }  
    public function destroy($id,CategoryServiceInterface $categoryService)
    {   
        $category = $categoryService->delete($id);
        if($category){
            return redirect('/categories')->with('message','Category deleted successfully');
        }  
        return redirect()->back()->with('error','Category not deleted,try again');
    }    
    public function edit($id,CategoryServiceInterface $categoryService)
    {
        $result = $categoryService->getById($id);
        return view('categories.edit',['category' => $result]);
    }
    public function update($id,CategoryServiceInterface $categoryService,Request $request)
    {
        $inputs = ['title' => $request->input('title')];
        $category = $categoryService->update($inputs,$id);
        if($category){   
            return redirect('/categories')->with('message','Category updated successfully');
        } 
        return redirect()->back()->with('message','Category not updated,try again');
    }
    public function show($id,CategoryServiceInterface $categoryService)
    {
        $category = $categoryService->getById($id);
        return view('categories.show',['category' => $category]);          
    }
}
    