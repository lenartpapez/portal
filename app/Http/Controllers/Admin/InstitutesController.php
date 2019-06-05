<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Institute;
use App\ContactPerson;

class InstitutesController extends Controller
{

   public function index() {
        $institutes = Institute::with('contacts');
        if(request()->has('search')) {
            $institutes = $institutes->where('name', 'like', '%'.request('search').'%');
        }
        if(request()->has('page')) {
            return $institutes->paginate(8);
        }
        if(request()->has('count')) {
            return response()->json([ 'institutes' => $institutes->count(), 'connectedInstitutes' => $institutes->has('goals')->count() ]);
        }
        return $institutes->get();
   }

   public function store(Request $request) {
        $institute = new Institute;
        $institute->name = $request->get('name');
        $institute->short = $request->get('short');
        $institute->website = $request->get('website');
        if($institute->save()) { 
            foreach($request->get('contacts') as $con) {
                $contactPerson = new ContactPerson;
                $contactPerson->contact_name = $con['contact_name'];
                $contactPerson->email = $con['email'];
                $institute->contacts()->save($contactPerson);
            }
            return response("Inštitut je bil uspešno dodan."); 
        }
        return response("Inštitut ni bil uspešno dodan.");  
   }


   public function show($id) {
       $institute = Institute::with('contacts', 'goals.field')->where('id', '=', $id)->first();
       return $institute->toJson();
   }

   public function update() {

   }

   public function destroy($id) {
     $institute = Institute::find($id);
     // $institute->contacts()->delete();
     $institute->goals()->detach();
     $institute->delete();
     return response("Inštitut " . $institute->name . " odstranjen.");
   }

   public function import(Request $request) {
       foreach( request('importData') as $institute ) {
           $currentInstitute = Institute::where("name", $institute[1])->first();
           if( !$currentInstitute ) {
               $newInstitute = new Institute;
               $newInstitute->name = $institute[1] != null ? $institute[1] : '';
               $newInstitute->short = $institute[2] != null ? $institute[2] : '';
               $newInstitute->save();
               $currentInstitute = $newInstitute;
           }
           $currentContactPerson = $currentInstitute->contacts()->where("contact_name", $institute[0])->first();
            if( !$currentContactPerson ) {
                $newContactPerson = new ContactPerson;
                $newContactPerson->contact_name = $institute[0] != null ? $institute[0] : '';
                $newContactPerson->email = $institute[3] != null ? $institute[3] : '';
                $currentInstitute->contacts()->save($newContactPerson);
            }            
       }
       return response("Inštituti in kontakti uvoženi.");
   }

  
}
