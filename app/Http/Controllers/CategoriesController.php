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
        if(Category::create(['title' => $request->input('title'),'user_id'=>Auth::id()]))
        {
            return redirect('/categories');
        } 
        return redirect()->back()->with('msg','Category not added,try again');
    }
    public function destroy($id)
    {   
        if(Category::where('id', $id)->delete())
        {
            return redirect('/categories');
        }
        return redirect()->back()->with('message','Something is wrong');
    }
    public function edit($id)
    {
        $result = Category::where('id',$id)->first();
        return view('categories.edit',['categories' => $result]);
    }
    public function update($id, Request $request)
    {
        if(Category::where('id', $id)->update(['title' => $request->input('title')]))
        {
            $result = Category::where('user_id',Auth::id())->get();
            return view('categories.index',['categories' => $result]);
        }
        return redirect()->back()->with('msg','Category not updated,try again');
    }    
}