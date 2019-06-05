<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;

class CompaniesController extends Controller
{
    public function index() {
        $companies = Company::with('contacts');
        if(request()->has('search')) {
            $companies = $companies->where('name', 'like', '%'.request('search').'%');
        }
        return view('pages.companies.index', ['companies' => $companies->sortable()->paginate(8)]);
   }

   public function show($id) {
       $company = Company::findOrFail($id);
       return view('pages.companies.company', ['company' => $company]);
   }
}
