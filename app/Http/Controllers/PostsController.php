<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
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
    public function index(Category $category,Post $post)
    {
        $my_posts = Post::paginate(2);
        $categories = $category->get();
        return view('post',['categories'=>$categories, 'my_posts'=>$my_posts]);
    }
    
    public function create(Category $category)
    {
        $my_categories = $category->where('user_id',Auth::id())->get();
        return view('add_post',['my_categories'=>$my_categories]);
    }
    public function store(PostRequest $request ,Post $post, Category $category)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        if($request->hasFile('image')) {    
            $image = $request->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $inputs['image']);
        } 
        else {    
            $inputs['image']='no-image.png';
        }
        $inputs['user_id'] = Auth::id();
        $post->create($inputs);
        return redirect('/posts');
       
    }

    public function destroy($id, Post $post)
    {   
        $post->where('id', $id)->delete();
        return redirect('/posts');

    }
    public function edit($id, Post $post,Category $category)
    {
        
        $my_categories = $category->where('user_id',Auth::id())->get();
        $posts=$post->where('id',$id)->first();
        return view('edit_post',['posts'=>$posts,'my_categories'=>$my_categories]);
    }

    public function update($id, Post $post, Category $category, PostRequest $request)
    {
        $post = $post->where('id', $id)->first();
        $old_image = $post->image;
        $inputs=$request->all();
        unset($inputs['_token']);
        unset($inputs['_method']);
        if($request->hasFile('image')) {    
             $image = $request->file('image');
             $inputs['image'] = time().'.'.$image->getClientOriginalName();
             $image->move(public_path('/image'), $inputs['image']);
             
        } 
        else {    
            $inputs['image']='no-image.png';
        }
        $post->update($inputs);
        if($inputs['image'] != 'no-image.png'){
            unlink(public_path('/image/').$old_image);
            $categories = $category->get();
            return redirect('/posts');
        }
    }
}    