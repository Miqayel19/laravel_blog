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
        $inputs = $request->storeInputs();
        if($request->hasFile('image')) {    
            $image = $request->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $inputs['image']);
        } else {    
            $inputs['image']='no-image.png';
        }
        $added_post = Post::create($inputs);
        $result = Post::where('user_id',Auth::id())->get(); 
        if($result)
        {
            return redirect('/posts')->with('message','Post added successfully');
        } 
        return redirect()->back()->with('msg','Post is not added,try again');
    }    
    public function edit($id)
    {
        $categories = Category::where('user_id',Auth::id())->get();
        $posts = Post::where('id',$id)->first();
        return view('posts.edit',['posts' => $posts,'my_categories' => $categories]);
    }
    public function update($id,PostRequest $request)
    {
        $post = Post::where('id', $id)->first();
        $old_image = $post->image;
        $inputs = $request->updateInputs();
        if($request->hasFile('image')) {    
            $image = $request->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $inputs['image']);
        } else {    
            $inputs['image']='no-image.png';
        }
        $updated_post = $post->update($inputs);
        if($inputs['image'] != 'no-image.png' && $updated_post) {
            unlink(public_path('/image/').$old_image);
            return redirect('/posts')->with('msg','Post updated successfully');
        } 
        return redirect()->back()->with('error', 'Post is not updated,something is wrong');
    }    
    public function destroy($id)
    {   
        $deleted_post = Post::where('id', $id)->delete();         
        if($deleted_post)
        {
            return redirect('/posts')->with('msg','Post deleted successfully');
        } 
        return redirect()->back()->with('msg','Something is wrong,post is not deleted');
    }    
}
        