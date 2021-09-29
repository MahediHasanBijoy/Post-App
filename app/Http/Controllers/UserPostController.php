<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        $post = $user->posts()->with('user','likes')->paginate(20);
        return view('users.posts.index')->with('user',$user)->with('posts',$post);
    }
}
