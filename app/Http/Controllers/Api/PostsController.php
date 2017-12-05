<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\PostRequest;
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
        $inputs = $request->postStore();
        if($request->hasFile('image')) {    
            $image = $request->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $inputs['image']);
        } else {    
            $inputs['image']='no-image.png';
        }
        $added_post = Post::create($inputs);
        $result = Post::where('user_id',Auth::id())->with('category')->orderby('id','desc')->get();
        if($result)
        {   
            return response()->json(['myposts' => $result], 200);
        }
        return response()->json(['error' => 'Post not added!'],400);
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
        $inputs = $request->postUpdate();
        if($request->hasFile('image')) {    
            $image = $request->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $inputs['image']);
        } else {    
            $inputs['image']='no-image.png';
        }
        $updated_post = $post->update($inputs);
        $result = Post::where('user_id',Auth::id())->with('category')->orderby('id','desc')->get(); 
        if($inputs['image'] != 'no-image.png' && $updated_post){
            unlink(public_path('/image/').$old_image);
            return response()->json(['myposts' => $result], 200);
        }
        return response()->json(['error' => 'Post not updated!'],400);
    } 
    public function destroy($id)
    {   
        Post::where('id', $id)->delete();
        $result = Post::where('user_id',Auth::id())->with('category')->get();
        if($result)
        {
            return response()->json(['myposts' => $result], 200);
        }
        return response()->json(['error' => 'Post not deleted!'],400);
    }
}        
