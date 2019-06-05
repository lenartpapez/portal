<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class SubpagesController extends Controller
{

    public function index($slug)
    {
        $auth_pages = ["extra1", "extra2", "extra3", "extra4"];

        if(!Auth::user() and in_array($slug, $auth_pages)) {
            throw new UnauthorizedException();
        }

        return view('pages/'.$slug);
    }
}
