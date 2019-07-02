<?php

namespace App\Http\Controllers\FrontPage;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function latest()
    {
        $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
        return view('welcome', compact('posts'));
    }

    public function all()
    {
        $posts = Post::paginate(6);
        return view('pages.posts.index', compact('posts'));
    }

    public function single($id)
    {
        $post = Post::findOrFail($id);
        return view('pages.posts.singlePost', compact('post'));
    }

    public function getComments($id)
    {
        $comments = Comment::with('user')->where('post_id', $id)->get();
        return $comments;
    }

    public function addComment(Request $request)
    {
        $comment = new Comment;
        $post = Post::findOrFail(request('post_id'));
        $comment->content = request('comment');
        $comment->user_id = Auth::user()->id;
        $comment->created_at = date("Y-m-d H:i:s");
        $comment->updated_at = date("Y-m-d H:i:s");
        $post->comments()->save($comment);
        return response("Komentar je bil dodan.");
    }
}
