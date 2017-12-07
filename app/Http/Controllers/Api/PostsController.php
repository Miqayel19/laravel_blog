<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\PostRequest;
use App\Contracts\PostServiceInterface;
use App\Contracts\CategoryServiceInterface;
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
        return response()->json(['status' => 'success','message' => 'Get All posts','resource' => $posts], 200);
    }
    public function myposts()
    {      
        $posts = Post::where('user_id',Auth::id())->with('category')->orderby('id','desc')->get();
        return response()->json(['status' => 'success','message' => 'Get My posts','resource' => $posts], 200);  
    }
    public function store(PostServiceInterface $postService,PostRequest $request)
    { 
        $inputs = $request->storeInputs();
        if($request->hasFile('image')) {    
            $image = $request->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $inputs['image']);
        } else {    
            $inputs['image'] = 'no-image.png';
        }
        $result = $postService->addPost($inputs);
        $post = Post::where('user_id',Auth::id())->with('category')->orderby('id','desc')->get();
        if($result){   
            return response()->json(['status' => 'success','message' => 'Post Added','resource' => $post], 200);
        }
        return response()->json(['status' => 'failed','message' => 'Post not added!'],400);
    }    
    public function edit($id,PostServiceInterface $postService)
    {    
        $result = $postService->editPost($id);
        return response()->json(['status' => 'success','resource' => $result], 200);
    }
    public function update($id,PostRequest $request,PostServiceInterface $postService)
    {
        $post = $postService->editPost($id);
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
        $result = Post::where('user_id',Auth::id())->with('category')->orderby('id','desc')->get(); 
        if($inputs['image'] != 'no-image.png' && $updated_post){
            unlink(public_path('/image/').$old_image);
            return response()->json(['status' => 'success','message' => 'Post updated','resource' => $result], 200);
        }
        return response()->json(['status' => 'failed','message' => 'Post not updated!'],400);
    } 
    public function destroy($id,PostServiceInterface $postService)
    {   
        $result = $postService->deletePost($id);
        $post = Post::where('user_id',Auth::id())->with('category')->get();
        if($result){
            return response()->json(['status' => 'success','message' => 'Post deleted','resource' => $post], 200);
        }
        return response()->json(['status' => 'failed','message' => 'Post not deleted!'],400);
    }
}        
