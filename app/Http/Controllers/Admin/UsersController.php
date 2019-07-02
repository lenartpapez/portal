<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        return User::with('roles')->whereDoesntHave('roles', function ($q) {
            $q->whereName('super_admin');
        })->get();
    }

    public function admins()
    {
        return User::with('roles')->whereHas('roles', function ($q) {
            $q->whereIn('name', ['admin', 'editor']);
        })->get();
    }

    public function grantRights($id, $role)
    {
        $user = User::findOrFail($id);
        $roleToGrant = Role::whereName($role)->first();
        if (!$user->roles->contains($roleToGrant->id)) {
            $user->roles()->attach($roleToGrant->id);
            return response('Uporabniku dodeljene ' . $role . ' pravice.');
        }
        return response('Uporabnik že ima ' . $role . ' pravice.');
    }

    public function removeRights($id, $role)
    {
        $user = User::findOrFail($id);
        $roleToGrant = Role::whereName($role)->first();

        $user->roles()->detach($roleToGrant->id);
        return response('Uporabniku odstranjene ' . $role . ' pravice.');
    }
}
