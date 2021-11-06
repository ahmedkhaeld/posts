<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::get(); //collection
        return view('posts.index', [
            'posts'=>$posts
        ]);
    }

    public function store(Request $request)
    {
        // validate
        $this->validate($request, [
            'body'=>'required'
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back();
    }
}
