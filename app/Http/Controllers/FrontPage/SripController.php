<?php

namespace App\Http\Controllers\FrontPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institute;
use App\Company;

class SripController extends Controller
{
    public function index($slug) {
        $companies = Company::with('goals')->get();
        if(request()->has('for_company')) {
            $company = Company::with('goals')->findOrFail(request('for_company'));
            $institutes = Institute::all();
            /*
                $institutes = ... Get all institutes with at least one same goal as this company.
            */
        }
        return view('pages.srip3/'.$slug, ['selectedCompany' => isset($company) ? $company : null, 'institutes' => isset($institutes) ? $institutes : null, 'companies' => $companies]);
    }


}
