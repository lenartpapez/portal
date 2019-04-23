<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;
use App\ContactPerson;

class CompaniesController extends Controller
{

   public function index() {
        $companies = Company::with('contacts');
        if(request()->has('search')) {
            $companies = $companies->where('name', 'like', '%'.request('search').'%');
        }
        if(request()->has('page')) {
            return $companies->paginate(8);
        }
        if(request()->has('count')) {
            return response()->json([ 'companies' => $companies->count(), 'connectedCompanies' => $companies->has('goals')->count() ]);
        }
        return $companies->get();
   }

   public function store() {

   }

   public function show($id) {
       $company = Company::with('contacts', 'goals.field')->where('id', '=', $id)->first();
       return $company->toJson();
   }

   public function update() {

   }

   public function destroy($id) {
     $company = Company::find($id);
     // $institute->contacts()->delete();
     $company->goals()->detach();
     $company->delete();
     return response("Podjetje " . $company->name . " odstranjeno.");
   }

   public function import(Request $request) {
       foreach( request('importData') as $company ) {
           $currentCompany = Company::where("name", $company[1])->first();
           if( !$currentCompany ) {
               $newCompany = new Company;
               $newCompany->name = $company[1] != null ? $company[1] : '';
               $newCompany->short = $company[2] != null ? $company[2] : '';
               $newCompany->save();
               $currentCompany = $newCompany;
           }
           $currentContactPerson = $currentCompany->contacts()->where("contact_name", $company[0])->first();
            if( !$currentContactPerson ) {
                $newContactPerson = new ContactPerson;
                $newContactPerson->contact_name = $company[0] != null ? $company[0] : '';
                $newContactPerson->email = $company[3] != null ? $company[3] : '';
                $currentCompany->contacts()->save($newContactPerson);
            }            
       }
       return response("Podjetja in kontakti uvoženi.");
   }

  
}
