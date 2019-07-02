<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\ContactPerson;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{

    public function index()
    {
        $companies = Company::with('contacts');
        if (request()->has('search')) {
            $companies = $companies->where('name', 'like', '%' . request('search') . '%');
        }
        if (request()->has('page')) {
            return $companies->paginate(8);
        }
        if (request()->has('count')) {
            return response()->json(['companies' => $companies->count(), 'connectedCompanies' => $companies->has('goals')->count()]);
        }
        return $companies->get();
    }

    public function store(Request $request)
    {
        $company = new Company;
        $company->name = $request->get('name');
        $company->short = $request->get('short');
        $company->website = $request->get('website');
        if ($company->save()) {
            foreach ($request->get('contacts') as $con) {
                $contactPerson = new ContactPerson;
                if($con['contact_name'] == '') {
                    $contactPerson->contact_name = '/';
                } else {
                    $contactPerson->contact_name = $con['contact_name'];
                }
                if($con['email'] == '') {
                    $contactPerson->email = '/';
                } else {
                    $contactPerson->email = $con['email'];
                }
                $company->contacts()->save($contactPerson);
            }
            return response("Podjetje je bilo uspešno dodano.");
        }
        return response("Podjetje ni bilo uspešno dodano.");
    }

    public function show($id)
    {
        $company = Company::with('contacts', 'goals.field')->where('id', '=', $id)->first();
        return $company->toJson();
    }

    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $company = Company::findOrFail($id);
        $company->name = $data['name'];
        $company->short = $data['short'];
        $company->website = $data['website'];
        if ($company->save()) {
            $company->contacts()->delete();
            foreach ($data['contacts'] as $con) {
                $c = new ContactPerson;
                if($con['contact_name'] == '') {
                    $c->contact_name = '/';
                } else {
                    $c->contact_name = $con['contact_name'];
                }
                if($con['email'] == '') {
                    $c->email = '/';
                } else {
                    $c->email = $con['email'];
                }
                $c->email = $con['email'];
                $company->contacts()->save($c);
            }
            $company->goals()->detach();
            foreach ($data['goals'] as $goal) {
                $company->goals()->attach($goal['id'], ['help' => $goal['pivot']['help'], 'investment_plan' => $goal['pivot']['investment_plan']]);
            }
            return response("Podjetje je bilo uspešno posodobljeno.");
        }
        return response("Podjetje ni bilo uspešno posodobljeno.");
    }

    public function deleteConnection()
    {
        $company = Company::find(request('company_id'));
        if ($company->goals()->detach(request('goal_id'))) {
            return response("Cilj odstranjen.");
        }
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        // $institute->contacts()->delete();
        $company->goals()->detach();
        $company->delete();
        return response("Podjetje " . $company->name . " odstranjeno.");
    }

    public function import(Request $request)
    {
        foreach (request('importData') as $company) {
            $currentCompany = Company::where("name", $company[1])->first();
            if (!$currentCompany) {
                $newCompany = new Company;
                $newCompany->name = $company[1] != null ? $company[1] : '';
                $newCompany->short = $company[2] != null ? $company[2] : '';
                $newCompany->save();
                $currentCompany = $newCompany;
            }
            $currentContactPerson = $currentCompany->contacts()->where("contact_name", $company[0])->first();
            if (!$currentContactPerson) {
                $newContactPerson = new ContactPerson;
                $newContactPerson->contact_name = $company[0] != null ? $company[0] : '';
                $newContactPerson->email = $company[3] != null ? $company[3] : '';
                $currentCompany->contacts()->save($newContactPerson);
            }
        }
        return response("Podjetja in kontakti uvoženi.");
    }

}
