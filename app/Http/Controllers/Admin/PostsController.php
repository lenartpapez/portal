<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Spatie\MediaLibrary\Models\Media;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::latest();
        if(request()->has('search')) {
            $posts = $posts->where('title', 'like', '%'.request('search').'%');
        }
        if(request()->has('page')) {
            return $posts->paginate(8);
        }
        return response(Post::all()->count());
    }

  
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->created_at = date("Y-m-d H:i:s");
        $post->updated_at = date("Y-m-d H:i:s");
        $image = $request->get('image');
        $post->addMedia($image)->toMediaCollection("featured");
        $post->save();
        return response("Objava ni bila uspešno dodana.");
    }

    public function show($id)
    {
        $post = Post::find($id);
        return $post->toJson();
    }


    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title=$request->get('title');
        $post->content=$request->get('content');
        $post->updated_at = date("Y-m-d H:i:s");
        $post->save();
        return response("Objava popravljena.");
    }

    public function destroy($ids)
    {
        $message = "Objava [ID: ".$ids."] je bila odstranjena.";
        $posts = explode(",", trim($ids, ','));
        foreach($posts as $postId) {
            $toDelete = Post::find($postId);
            $toDelete->delete();
        }
        if(sizeof($posts) > 1) $message = trim("Objave so bile odstranjene. ID: [".implode(', ', $posts)."]");
        return response([Post::latest()->get(), $message]);
    }

}
