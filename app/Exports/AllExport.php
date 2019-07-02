<?php

namespace App\Exports;

use App\Institute;
use App\Company;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class AllExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{

    use Exportable;

    public function __construct($slug) {
        $this->slug = $slug;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        if($this->slug == 'companies') {
            $class = Company::class;
        } else {
            $class = Institute::class;
        }
        return $class::with('contacts');
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

    public function map($data): array {
        $contacts = "";
        foreach($data->contacts as $contact) {
            $contacts = $contacts.$contact->contact_name." - ".$contact->email.PHP_EOL;
        }
        return [
            $data->id,
            $data->name,
            $data->short,
            $data->website,
            $contacts
        ];
    }
}
