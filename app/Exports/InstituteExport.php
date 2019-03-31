<?php

namespace App\Exports;

use App\Institute;
use Maatwebsite\Excel\Concerns\FromCollection;

class InstituteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Institute::all();
    }
}
