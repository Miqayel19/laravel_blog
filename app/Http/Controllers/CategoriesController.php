<?php

namespace App\Http\Controllers;

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
        $result = Category::create(['title' => $request->input('title'),'user_id' => Auth::id()]); 
        if($result)
        {
            return redirect('/categories')->with('msg','Category added successfully');
        } 
        return redirect()->back()->with('msg','Category not added,try again');
    }  
    public function destroy($id)
    {   
        $result = Category::where('id', $id)->delete();
        if($result)
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
    public function update($id, Request $request)
    {
        $result = Category::where('id', $id)->update(['title' => $request->input('title')]);
        if($result)
        {   
            return redirect('/categories')->with('msg','Category updated successfully');
        } 
        return redirect()->back()->with('msg','Category not updated,try again');
           
    }
}    