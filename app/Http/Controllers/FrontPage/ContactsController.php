<?php

namespace App\Http\Controllers\FrontPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Link;

class ContactsController extends Controller
{
    public function index()
    {
        $category_id = Category::where('title', 'Kontakti')->first()->id;
        $links = Link::where('category_id', $category_id)->get();
        return view('pages.contacts.index', compact('links'));;
    }
}
