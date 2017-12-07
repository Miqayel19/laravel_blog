<?php

namespace App\Http\Controllers;
use App\Category;
use App\Post;
use Auth;

class HomeController extends Controller
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
        $categories = Category::get();
        $posts = Post::get();
        return view('home',['categories' => $categories,'posts' => $posts]);        
    }
}
