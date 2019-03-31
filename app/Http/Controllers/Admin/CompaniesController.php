<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;

class CompaniesController extends Controller
{

   public function index() {
        $companies = Company::query();
        if(request()->has('search')) {
            $companies = $companies->where('name', 'like', '%'.request('search').'%');
        }
        if(request()->has('page')) {
            return $companies->paginate(8);
        }
        return response(Company::all());
   }
}
