<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest();
        if (request()->has('search')) {
            $posts = $posts->where('title', 'like', '%' . request('search') . '%');
        }
        if (request()->has('page')) {
            return $posts->paginate(8);
        }
        return response(Post::all()->count());
    }

    public function store(Request $request)
    {
        ini_set('memory_limit', '256M');
        $post = new Post;
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->created_at = date("Y-m-d H:i:s");
        $post->updated_at = date("Y-m-d H:i:s");
        $saved = $post->save();
        if ($saved and $request->hasFile("image")) {
            // ini_set("memory_limit", "1G");
            $image = $request->file('image');
            $post->addMedia($image)->toMediaCollection('featured');
            return response("Objava je bila uspešno dodana.");
        }
        return response("Objava ni bila uspešno dodana.");
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->image = $post->getFirstMediaUrl('featured', 'thumb');
        return $post;
    }

    public function update(Request $request, $id)
    {
        ini_set('memory_limit', '256M');
        $post = Post::findOrFail($id);
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->updated_at = date("Y-m-d H:i:s");
        $post->save();
        if($request->hasFile("image"))
        {
            $image = $request->file('image');
            $post->getFirstMedia('featured')->delete();
            $post->addMedia($image)->toMediaCollection('featured');
            return response("Objava je bila uspešno popravljena.");
        }
        return response("Objava je bila uspešno popravljena.");
    }

    public function destroy($id)
    {
        $success = "Objava je bila odstranjena.";
        $error = "Objava je bila odstranjena.";
        $post = Post::findOrFail($id);
        $post->comments()->delete();
        if ($post->delete()) {
            return response($success);
        }
        return response($error);
    }
}
