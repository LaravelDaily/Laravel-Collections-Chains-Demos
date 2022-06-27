<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateRepositoryDetails;
use App\Models\Organization;
use App\Models\Repository;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ExampleController extends Controller
{
    public function example1()
    {
        $role = Role::with('permissions')->first();
        $permissionsListToShow = $role->permissions
            ->map(fn($permission) => $permission->name)
            ->implode("<br>");

        // ALTERNATIVE - WITH ARRAYS
        /*
        $permissionsArrayToShow = [];
        foreach ($role->permissions as $permission) {
            $permissionsArrayToShow[] = $permission->name;
        }
        $permissionsListToShow = implode("<br>", $permissionsArrayToShow);
        */

        return view('example1');
    }

    public function example2()
    {
        Artisan::call('twitter:giveaway', [
            '--exclude' => ['someuser', '@otheruser']
        ]);

        return view('example2');
    }

    public function example3()
    {
        $user = User::first();
        $socialLinks = collect([
            'Twitter' => $user->link_twitter,
            'Facebook' => $user->link_facebook,
            'Instagram' => $user->link_instagram,
        ])
            ->filter()
            ->map(fn ($link, $network) => '<a href="' . $link . '">' . $network . '</a>')
            ->implode(' | ');

        // ALTERNATIVE - WITH ARRAYS
        /*
        $socialLinksArray = [
            'Twitter' => $user->link_twitter,
            'Facebook' => $user->link_facebook,
            'Instagram' => $user->link_instagram,
        ];
        $socialLinksArray = array_filter($socialLinksArray, fn($item) => $item != '');
        array_walk($socialLinksArray, fn($link, $network) => '<a href="' . $link . '">' . $network . '</a>');
        $socialLinks = implode(' | ', $socialLinksArray);
        */

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

        // No alternatives with arrays this time, this code uses Eloquent relations power

        return view('example4');
    }
}
