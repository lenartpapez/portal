<?php

namespace App\Http\Controllers;

use App\Company;
use App\Field;
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

        if($slug == 'podjetja') {
            return view($slug)->with('companies', Company::all());
        }

        if($slug == 'srip3' || $slug == 'srip4') {
            return view($slug)->with('fields', Field::all());
        }

        return view($slug);
    }
}
