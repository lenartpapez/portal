<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Field;
use App\Goal;
use App\Institute;
use App\Company;

class WizardController extends Controller
{

   public function storeIG(Request $request) {
        $institute = Institute::find(request('institute_id'));
        $goal = request('goal_id');
        $services = request('services');
        $possibilities = request('possibilities');
        $institute->goals()->attach( $goal, ['services' => $services, 'possibilities' => $possibilities] );
        return response("Povezava ustvarjena."); 
   }

   public function storeCG(Request $request) {
        $company = Company::find(request('company_id'));
        $goal = request('goal_id');
        $help = request('help');
        $investment_plan = request('investment_plan');
        $company->goals()->attach( $goal, ['help' => $help, 'investment_plan' => $investment_plan] );
        return response("Povezava ustvarjena.");
   }
}
