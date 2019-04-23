<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Goal;

class GoalsController extends Controller
{
    public function index() {

        $goals = Goal::query();
        
        if(request()->has('field_id')) {
            return $goals->where('field_id', request('field_id'))->get();
       }
        if(request()->has('count')) {
            return $goals->count();
        }
        return $goals;
   }
}
