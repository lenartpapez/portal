<?php

namespace App\Http\Controllers\FrontPage;

use App\Exports\AllExport;
use App\Exports\ResultsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportAll($slug)
    {
        return Excel::download(new AllExport($slug), $slug . '.xlsx');
    }

    public function exportResults($slug, $itemId, $goalId)
    {
        return Excel::download(new ResultsExport($slug, $itemId, $goalId), 'results.xlsx');
    }

}
