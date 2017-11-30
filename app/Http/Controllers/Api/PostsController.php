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
        $result = Post::where('user_id',Auth::id())->with('category')->orderby('id','desc')->get();
        return response()->json(['myposts' => $result], 200);
       
    }
    public function edit($id)
    {    
        $result=Post::where('id',$id)->first();
        return response()->json(['myposts' => $result], 200);
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
        $result = Post::where('user_id',Auth::id())->with('category')->get();
        return response()->json(['myposts' => $result], 200);
    }
}    
