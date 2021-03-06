<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    public function index()
    {
        $fields = Field::query();
        if (request()->has('srip_id')) {
            return $fields->where('srip_id', request('srip_id'))->get();
        }
        if (request()->has('count')) {
            return $fields->count();
        }
        return $fields;
    }
}
