<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::orderBy('created_at','desc')-> with(['user', 'likes'])->Paginate(20); //collection
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

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}
