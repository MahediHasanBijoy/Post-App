<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
    	//$posts = Post::get();//this return all posts as collection
    	$posts = Post::orderBy('created_at', 'desc')->with(['user','likes'])->paginate(20);//pagination

    	return view('posts.index',['posts'=>$posts]);
    }

    public function show(Post $post)
    {
        return view ('posts.show',[
        'post'=>$post]);
    }




    public function store(Request $request)
    {
    	//validate
    	$this->validate($request, [
    		'body'=>'required',
    	]);

    	$request->user()->posts()->create([

    		'body'=>$request->body,
    	]);
    	return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $this->authorize('delete',$post);

        $post->delete();

        return back();
    }
}
