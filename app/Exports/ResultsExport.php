<?php

namespace App\Exports;

use App\Company;
use App\Institute;
use App\Goal;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class ResultsExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{

    use Exportable;

    public function __construct($slug, $itemId, $goalId)
    {
        $this->slug = $slug;
        $this->itemId = $itemId;
        $this->goalId = $goalId;
        $this->headings_companies = ['Podjetje', 'Kratica', 'Spletna stran', 'Kontakti', 'Pomanjkljivosti in potrebna pomoč', 'Investicijski plan'];
        $this->headings_institutes = ['Inštitut', 'Kratica', 'Spletna stran', 'Kontakti', 'Storitve, ki jih nudijo', 'Možnost aplikacije v prakso'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        if($this->slug == 'companies') {
            $class = Company::class;
            $relatedClass = Institute::class;
        } else {
            $class = Institute::class;
            $relatedClass = Company::class;
        }
        $item = $class::findOrFail($this->itemId);
        $goal = $item->goals()->where('id', '=', $this->goalId)->firstOrFail();
        $id = $this->goalId;
        $related = $relatedClass::whereHas("goals", function ($query) use ($id) {
            $query->where("id", $id);
        });
        return $related;
    }

    public function headings(): array
    {
        if($this->slug == 'companies') {
            $company = Company::findOrFail($this->itemId);
            $goal = $company->goals()->with('field')->where('goal_id', $this->goalId)->first();
            return [ 
                [ 'Podjetje', 'Področje', 'Cilj', 'Pomanjkljivosti in potrebna pomoč', 'Investicijski plan' ],
                [ $company->name, 
                    $goal->field->name, 
                    $goal->name,
                    $goal->pivot->help,
                    $goal->pivot->investment_plan
                ],
                [],
                $this->headings_institutes
            ];
        }
        $institute = Institute::findOrFail($this->itemId);
        $goal = $institute->goals()->with('field')->where('goal_id', $this->goalId)->first();
        return  [
            [ 'Inštitut', 'Področje', 'Cilj', 'Storitve, ki jih nudijo', 'Možnost aplikacije v prakso' ],
            [ $institute->name, 
                    $goal->field->name, 
                    $goal->name,
                    $goal->pivot->services,
                    $goal->pivot->possibilities
            ],
            [],
            $this->headings_companies
        ];
    }

    public function map($data): array {
        $contacts = "";
        $pivot_1 = null;
        $pivot_2 = null;
        foreach($data->contacts as $contact) {
            $contacts = $contacts.$contact->contact_name." - ".$contact->email.PHP_EOL;
        }
        foreach($data->goals as $goal) {
            if($goal->id == $this->goalId) {
                if($this->slug == 'companies') {
                    $pivot_1 = $goal->pivot->services;
                    $pivot_2 = $goal->pivot->possibilities;
                } else {
                    $pivot_1 = $goal->pivot->help;
                    $pivot_2 = $goal->pivot->investment_plan;
                }
            }
        }
        return [
            $data->name,
            $data->short,
            $data->website,
            $contacts,
            $pivot_1,
            $pivot_2
        ];
    }
}
