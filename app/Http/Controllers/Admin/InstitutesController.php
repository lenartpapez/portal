<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Institute;

class InstitutesController extends Controller
{

   public function index() {
        $institutes = Institute::query();
        if(request()->has('search')) {
            $institutes = $institutes->where('name', 'like', '%'.request('search').'%');
        }
        if(request()->has('page')) {
            return $institutes->paginate(8);
        }
        return response(Institute::all());
   }

   public function store() {

   }

   public function show($id) {
       $institute = Institute::with('goals.field')->where('id', '=', $id)->first();
       return $institute->toJson();
   }

   public function update() {

   }

   public function destroy() {

   }

  
}
