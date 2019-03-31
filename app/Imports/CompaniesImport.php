<?php

namespace App\Imports;

use App\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CompaniesImport implements WithMultipleSheets, ToModel, WithStartRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if(!isset($row[0])) return null;

        return new Company([
            'contact_name' => $row[0],
            'name' => $row[1],
            'short' =>  $row[2],
            'email' =>  $row[3]
        ]);
    }

    public function sheets(): array
    {
        return [
            "Inštitucije" => new static
        ];
    }

    public function startRow(): int
    {
        return 2;
    }

}