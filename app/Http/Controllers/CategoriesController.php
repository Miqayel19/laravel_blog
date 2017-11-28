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
    public function index()
    {      
        return view('category');   
    }
    public function create()
    {
        return view('add_category');
    }
    public function store(Request $request)
    {
        Category::create(['title' => $request->input('title'),'user_id'=>Auth::id()]);
        return redirect('/categories');
    }
    public function destroy($id)
    {   
        if(Category::where('id', $id)->delete());
        {
            return redirect('/categories');
        }
    }
    public function edit($id)
    {
        $result=Category::where('id',$id)->first();
        return view('edit_category',['categories'=>$result]);
    }
    public function update($id, Request $request)
    {
        Category::where('id', $id)->update(['title' => $request->input('title')]);
        $categories =Category::where('user_id',Auth::id())->get();
        return view('category',['categories'=>$categories]);
    }
}