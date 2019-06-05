<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Institute;

class InstitutesController extends Controller
{
    public function index() {
        $institutes = Institute::with('contacts');
        if(request()->has('search')) {
            $institutes = $institutes->where('name', 'like', '%'.request('search').'%');
        }
        return view('pages.institutes.index', ['institutes' => $institutes->paginate(8)]);
   }

   public function show($id) {
       $institute = Institute::findOrFail($id);
       return view('pages.institutes.institute', ['institute' => $institute]);
   }
}
