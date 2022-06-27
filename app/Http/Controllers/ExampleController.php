<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateRepositoryDetails;
use App\Models\Organization;
use App\Models\Repository;
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

    public function example4()
    {
        Repository::query()
            ->with('owner')
            ->get()
            ->reject(function (Repository $repository): bool {
                return $repository->owner instanceof User && $repository->owner->github_access_token === null;
            })
            ->reject(function (Repository $repository): bool {
                return $repository->owner instanceof Organization
                    && $repository->owner->members()
                        ->whereNotNull('github_access_token')
                        ->whereNotNull('registered_at')
                        ->doesntExist();
            })
            ->each(static function (Repository $repository): void {
                UpdateRepositoryDetails::dispatch($repository);
            });

        return view('example4');
    }
}
