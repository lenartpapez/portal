<?php

namespace App\Http\Controllers\FrontPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institute;
use App\Company;

class SripController extends Controller
{
    public function index($slug)
    {
        if($slug == 'companies') {
            $companies = Company::with('goals')->get();
        } else {
            $institutes = Institute::with('goals')->get();
        }
        if (request()->has('for_company')) {
            $company = Company::with('goals')->findOrFail(request('for_company'));
            $goals = $company->goals->pluck("id");
            $institutes = Institute::whereHas("goals", function ($query) use ($goals) {
                $query->whereIn("id", $goals);
            })->get();
        }
        if (request()->has('for_institute')) {
            $institute = Institute::with('goals')->findOrFail(request('for_institute'));
            $goals = $institute->goals->pluck("id");
            $companies = Company::whereHas("goals", function ($query) use ($goals) {
                $query->whereIn("id", $goals);
            })->get();
        }
        return view('pages.srip3/'.$slug, ['selectedCompany' => isset($company) ? $company : null, 
                                            'selectedInstitute' => isset($institute) ? $institute : null,
                                            'institutes' => isset($institutes) ? $institutes : null, 
                                            'companies' => isset($companies) ? $companies : null]);
    }
}
