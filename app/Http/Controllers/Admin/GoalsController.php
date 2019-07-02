<?php

namespace App\Http\Controllers\Admin;

use App\Goal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoalsController extends Controller
{
    public function index()
    {

        $goals = Goal::query();

        if (request()->has('field_id')) {
            return $goals->where('field_id', request('field_id'))->get();
        }
        if (request()->has('count')) {
            return $goals->count();
        }
        return $goals;
    }
}
