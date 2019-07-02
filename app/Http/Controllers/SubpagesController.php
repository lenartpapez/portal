<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class SubpagesController extends Controller
{

    public function index($slug)
    {
        return view('pages/'.$slug.'/index');
    }
}
