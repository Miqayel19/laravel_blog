<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Contracts\PostServiceInterface;
use App\Contracts\CategoryServiceInterface;
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
    public function create(CategoryServiceInterface $categoryService)
    {
        $categories = $categoryService->getCategoryByUser(Auth::id());
        return view('posts.create',['my_categories' => $categories]);
    }
    public function store(PostServiceInterface $postService,PostRequest $request)
    {
        $inputs = $request->storeInputs();
        if($request->hasFile('image')) {    
            $image = $request->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('/image'), $inputs['image']);
        } else {    
            $inputs['image']='no-image.png';
        }
        $result = $postService->addPost($inputs);
        if($result){
            return redirect('/posts')->with('message','Post added successfully');
        } 
        return redirect()->back()->with('error','Post is not added,try again');
    }    
    public function edit($id,CategoryServiceInterface $categoryService,PostServiceInterface $postService)
    {
        $categories = $categoryService->getCategoryByUser(Auth::id());
        $posts = $postService->editPost($id);
        return view('posts.edit',['posts' => $posts,'my_categories' => $categories]);
    }
    public function update($id,PostServiceInterface $postService,PostRequest $request)
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
        $result = $post->update($inputs);
        if($inputs['image'] != 'no-image.png' && $result) {
            unlink(public_path('/image/').$old_image);
            return redirect('/posts')->with('message','Post updated successfully');
        } 
        return redirect()->back()->with('error', 'Post is not updated,something is wrong');
    }    
    public function destroy($id,PostServiceInterface $postService)
    {   
        $result = $postService->deletePost($id);         
        if($result){
            return redirect('/posts')->with('message','Post deleted successfully');
        } 
        return redirect()->back()->with('error','Something is wrong,post is not deleted');
    }    
}
        