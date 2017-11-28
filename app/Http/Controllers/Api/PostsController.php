<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Category;
use App\Post;
use App\User; 
use Auth;
class PostsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Category $category,Post $post)
    { 
        $posts = $post->get();
        return response()->json(['posts' => $posts], 200);
    }
    public function myposts(Post $post)
    {      
        $my_posts = $post->where('user_id',Auth::id())->with('category')->get();
        return response()->json(['myposts' => $my_posts], 200);  
    }
    public function add(PostRequest $request)
    { 
        $info = $request->all();
        unset($info['_token']);
        if($request->hasFile('image')) {    
            $image = $request->file('image');
            $info['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $info['image']);
        } 
        else {
            $info['image']='no-image.png';
        }
        $info['user_id'] = Auth::id();
        $my_posts = Post::create($info);
        return response()->json(['myposts' => $my_posts], 200);
       
    }
    public function edit($id)
    {    
        $my_posts=Post::where('id',$id)->first();
        return response()->json(['myposts' => $my_posts], 200);
    }
    
    public function update($id,Request $request)
    {
        $post = Post::where('id', $id)->first();
        $old_image = $post->image;
        $info=$request->all();
        unset($info['_token']);
        unset($info['_method']);
        if($request->hasFile('image')) { 
             $image = $request->file('image');
             $info['image'] = time().'.'.$image->getClientOriginalName();
             $image->move(public_path('/image'), $info['image']);
        } 
        else {    
            $info['image']='no-image.png';
        }
        $result = $post->update($info);
        if($info['image'] != 'no-image.png'){
            unlink(public_path('/image/').$old_image);
            return response()->json(['myposts' => $result], 200);
        }
    } 
    public function destroy($id)
    {   
        Post::where('id', $id)->delete();
        $my_posts = Post::where('user_id',Auth::id())->get();
        return response()->json(['myposts' => $my_posts], 200);
    }
}    
