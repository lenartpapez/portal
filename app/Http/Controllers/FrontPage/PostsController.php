<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function latest() {
        $latest_posts = Post::orderBy('created_at', 'desc')->take(3)->get();
        return view('welcome', ['posts' => $latest_posts]);
    }

    public function all() {
        $posts = Post::paginate(6);
        return view('posts.index', ['posts' => $posts]);
    }

    public function single($id) {
        $post = Post::find($id);
        return view('posts.singlePost', ['post' => $post]);
    }

    public function getComments($id) {
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->get();
        return response($comments);
    }

    public function getUser() {
        $logged = Auth::user() != null;
        return response((string)$logged);
    }

    public function addComment(Request $request)
    {
        $comment = new Comment;
        $comment->username = Auth::user()->name;
        $comment->post_id = $request->get('id');
        $comment->content = $request->get('comment');
        $comment->created_at = date("Y-m-d H:i:s");
        $comment->updated_at = date("Y-m-d H:i:s");
        $comment->save();
        return response("Komentar je bil dodan.");
    }
}
