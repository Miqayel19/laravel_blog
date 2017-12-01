<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Requests\PostRequest;
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
    public function index()
    { 
        $posts = Post::get();
        return response()->json(['posts' => $posts], 200);
    }
    public function myposts()
    {      
        $posts = Post::where('user_id',Auth::id())->with('category')->orderby('id','desc')->get();
        return response()->json(['myposts' => $posts], 200);  
    }
    public function add(PostRequest $request)
    { 
        $post = $request->postStore();
        $added_post = Post::create($post);
        $result = Post::where('user_id',Auth::id())->with('category')->orderby('id','desc')->get();
        return response()->json(['myposts' => $result], 200);
    }
    public function edit($id)
    {    
        $result = Post::where('id',$id)->first();
        return response()->json(['myposts' => $result], 200);
    }
    
    public function update($id,PostRequest $request,Post $post)
    {
        $post = Post::where('id', $id)->first();
        $old_image = $post->image;
        $info = $request->postUpdate();
        $updated_post = $post->update($info);
        $result = Post::where('user_id',Auth::id())->with('category')->orderby('id','desc')->get(); 
        if($info['image'] != 'no-image.png'){
            unlink(public_path('/image/').$old_image);
            return response()->json(['myposts' => $result], 200);
        }
    } 
    public function destroy($id)
    {   
        Post::where('id', $id)->delete();
        $result = Post::where('user_id',Auth::id())->with('category')->get();
        return response()->json(['myposts' => $result], 200);
    }
}    
