<?php

namespace App\Http\Controllers\FrontPage;

use App\Category;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::with('links')->get();
        return view('pages.links.index', compact('categories'));
    }
}
