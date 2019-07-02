<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::with('category');
        if (request()->has('search')) {
            $links = $links->where('text', 'like', '%' . request('search') . '%');
        }
        if (request()->has('page')) {
            return $links->paginate(8);
        }
        return $links->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::findOrFail(request('category'));

        $link = new Link;
        $link->text = request('text');
        $link->url = request('url');

        $category->links()->save($link);
        return response('Povezava ustvarjena');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Link::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail(request('category'));

        $link = Link::findOrFail($id);
        $link->text = request('text');
        $link->url = request('url');

        $category->links()->save($link);
        return response('Povezava uspešno posodobljena.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();
        return response('Povezava odstranjena');
    }
}
