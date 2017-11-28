<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
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
        return view('post',['categories'=>$categories, 'my_posts'=>$posts]);
    }
    public function create()
    {
        $categories = Category::where('user_id',Auth::id())->get();
        return view('add_post',['my_categories'=>$categories]);
    }
    public function store(PostRequest $request)
    {
        Post::create( $request->post_store());
        return redirect('/posts');
    }
    public function destroy($id)
    {   
        Post::where('id', $id)->delete();
        return redirect('/posts');
    }
    public function edit($id)
    {
        $categories = Category::where('user_id',Auth::id())->get();
        $posts=Post::where('id',$id)->first();
        return view('edit_post',['posts'=>$posts,'my_categories'=>$categories]);
    }
    public function update($id, Post $post,PostRequest $request)
    {
        $post = Post::where('id', $id)->first();
        $old_image = $post->image;
        $request->post_update();
        $post->update($inputs);
        if($inputs['image'] != 'no-image.png'){
            unlink(public_path('/image/').$old_image);
            return redirect('/posts');
        }
    }
}    