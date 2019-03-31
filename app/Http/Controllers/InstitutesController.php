<?php

namespace App\Http\Controllers;

use App\Exports\InstituteExport;
use App\Imports\CompaniesImport;
use App\Company;
use Maatwebsite\Excel\Facades\Excel;

class InstitutesController extends Controller
{
    public function export()
    {
        return Excel::download(new InstituteExport, 'users.xlsx');
    }

    public function import()
    {
        Excel::import(new CompaniesImport, request()->file('import'));
        return redirect('/instituti' )->with('success', 'All good!');
    }
}
