<?php

namespace App\Http\Controllers\Admin;

use App\ContactPerson;
use App\Http\Controllers\Controller;
use App\Institute;
use Illuminate\Http\Request;

class InstitutesController extends Controller
{

    public function index()
    {
        $institutes = Institute::with('contacts');
        if (request()->has('search')) {
            $institutes = $institutes->where('name', 'like', '%' . request('search') . '%');
        }
        if (request()->has('page')) {
            return $institutes->paginate(8);
        }
        if (request()->has('count')) {
            return response()->json(['institutes' => $institutes->count(), 'connectedInstitutes' => $institutes->has('goals')->count()]);
        }
        return $institutes->get();
    }

    public function store(Request $request)
    {
        $institute = new Institute;
        $institute->name = $request->get('name');
        $institute->short = $request->get('short');
        $institute->website = $request->get('website');
        if ($institute->save()) {
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
                $institute->contacts()->save($contactPerson);
            }
            return response("Inštitucija je bila uspešno dodana.");
        }
        return response("Inštitucija ni bila uspešno dodana.");
    }

    public function deleteConnection()
    {
        $institute = Institute::find(request('institute_id'));
        if ($institute->goals()->detach(request('goal_id'))) {
            return response("Cilj odstranjen.");
        }
    }

    public function show($id)
    {
        $institute = Institute::with('contacts', 'goals.field')->where('id', '=', $id)->first();
        return $institute->toJson();
    }

    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $institute = Institute::findOrFail($id);
        $institute->name = $data['name'];
        $institute->short = $data['short'];
        $institute->website = $data['website'];
        if ($institute->save()) {
            $institute->contacts()->delete();
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
                $institute->contacts()->save($c);
            }
            $institute->goals()->detach();
            foreach ($data['goals'] as $goal) {
                $institute->goals()->attach($goal['id'], ['services' => $goal['pivot']['services'], 'possibilities' => $goal['pivot']['possibilities']]);
            }
            return response("Inštitucija je bila uspešno posodobljena.");
        }
        return response("Inštitucija ni bila uspešno posodobljena.");
    }

    public function destroy($id)
    {
        $institute = Institute::find($id);
        // $institute->contacts()->delete();
        $institute->goals()->detach();
        $institute->delete();
        return response("Inštitucija " . $institute->name . " odstranjena.");
    }

    public function import(Request $request)
    {
        foreach (request('importData') as $institute) {
            $currentInstitute = Institute::where("name", $institute[1])->first();
            if (!$currentInstitute) {
                $newInstitute = new Institute;
                $newInstitute->name = $institute[1] != null ? $institute[1] : '';
                $newInstitute->short = $institute[2] != null ? $institute[2] : '';
                $newInstitute->save();
                $currentInstitute = $newInstitute;
            }
            $currentContactPerson = $currentInstitute->contacts()->where("contact_name", $institute[0])->first();
            if (!$currentContactPerson) {
                $newContactPerson = new ContactPerson;
                $newContactPerson->contact_name = $institute[0] != null ? $institute[0] : '';
                $newContactPerson->email = $institute[3] != null ? $institute[3] : '';
                $currentInstitute->contacts()->save($newContactPerson);
            }
        }
        return response("Inštitucije in kontakti uvoženi.");
    }

}
