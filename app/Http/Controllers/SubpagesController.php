<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SubpagesController extends Controller
{

    public function index($slug)
    {
        return view('pages/'.$slug.'/index');
    }
}
