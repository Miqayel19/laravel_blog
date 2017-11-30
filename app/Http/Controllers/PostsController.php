<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Auth;
class PostsController extends Controller
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
        $posts = Post::where('user_id',Auth::id())->paginate(2);
        $categories = Category::get();
        return view('posts.index',['categories' => $categories, 'my_posts' => $posts]);
    }
    public function create()
    {
        $categories = Category::where('user_id',Auth::id())->get();
        return view('posts.add',['my_categories' => $categories]);
    }
    public function store(PostRequest $request)
    {
        Post::create($request->postStore());
        return redirect('/posts');
    }
    public function edit($id)
    {
        $categories = Category::where('user_id',Auth::id())->get();
        $posts = Post::where('id',$id)->first();
        return view('posts.edit',['posts' => $posts,'my_categories' => $categories]);
    }
    public function update($id, Post $post,PostRequest $request)
    {
        $post = Post::where('id', $id)->first();
        $old_image = $post->image;
        $request->postUpdate();
        $post->update($inputs);
        if($inputs['image'] != 'no-image.png'){
            unlink(public_path('/image/').$old_image);
            return redirect('/posts');
        }
        return redirect()->back()->with('error', 'Error');
    }
    public function destroy($id)
    {   
        if(Post::where('id', $id)->delete())
        {
            return redirect('/posts');
        }
        return redirect()->back()->with('msg','Something is wrong');
    }
}        