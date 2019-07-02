<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use App\Institute;
use Illuminate\Http\Request;

class InstitutesController extends Controller
{
    public function index()
    {
        $institutes = Institute::query();
        if (request()->has('search')) {
            $institutes = $institutes->where('name', 'like', '%' . request('search') . '%');
        }
        return view('pages.institutes.index', ['institutes' => $institutes->sortable()->paginate(8)]);
    }

    public function show($id)
    {
        $institute = Institute::findOrFail($id);
        return view('pages.institutes.institute', ['institute' => $institute]);
    }
}
