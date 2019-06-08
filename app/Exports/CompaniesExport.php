<?php

namespace App\Exports;

use App\Company;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class CompaniesExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Company::with('contacts');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Ime',
            'Kratica',
            'Spletna stran',
            'Kontakti'
        ];
    }

    public function map($company): array {
        $contacts = "";
        foreach($company->contacts as $contact) {
            $contacts = $contacts.$contact->contact_name." - ".$contact->email.PHP_EOL;
        }
        return [
            $company->id,
            $company->name,
            $company->short,
            $company->website,
            $contacts
        ];
    }
}
