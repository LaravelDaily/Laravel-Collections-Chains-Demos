<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function example1()
    {
        $role = Role::with('permissions')->first();
        $permissionsListToShow = $role->permissions
            ->map(function ($permission) {
                return $permission->name;
            })
            ->implode("<br>");

        return view('example1', compact('role', 'permissionsListToShow'));
    }

    public function example2()
    {
        return view('example2');
    }

    public function example3()
    {
        $user = User::first();

        return view('example3', compact('user'));
    }
}
