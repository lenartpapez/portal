<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Field;
use App\Goal;
use App\Institute;

class WizardController extends Controller
{
    public function availableFields(Request $request) {
       if(request()->has('srip_id')) {
            return Field::where('srip_id', request('srip_id'))->get();
       }
   }

   public function availableGoals(Request $request) {
       if(request()->has('field_id')) {
            return Goal::where('field_id', request('field_id'))->get();
       }
   }

   public function storeIG(Request $request) {
        $institute = Institute::find(request('institute_id'));
        $goal = request('goal_id');
        $services = request('services');
        $possibilities = request('possibilities');
        $institute->goals()->attach( $goal, ['services' => $services, 'possibilities' => $possibilities] );
        return response("Povezava ustvarjena."); 
   }

   public function storeCG(Request $request) {
       if(request()->has('company_id') && request()->has('goal_id')) {
           DB::table('company_goal')->insert(
               ['company_id' => request('company_id'), 'goal_id' => request('goal_id')]
           );
           return response("Povezava ustvarjena.");
       }
   }
}
