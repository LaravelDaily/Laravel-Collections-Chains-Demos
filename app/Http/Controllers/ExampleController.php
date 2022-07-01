<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateRepositoryDetails;
use App\Models\Comment;
use App\Models\Event;
use App\Models\Organization;
use App\Models\Repository;
use App\Models\Role;
use App\Models\User;
use App\Notifications\YouWereMentionedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ExampleController extends Controller
{
    public function example1()
    {
        $role = Role::with('permissions')->first();
        $permissionsListToShow = $role->permissions
            ->map(fn($permission) => $permission->name)
            ->implode("<br>");

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
            ->map(fn($link, $network) => '<a href="' . $link . '">' . $network . '</a>')
            ->implode(' | ');

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

    public function example5()
    {
        $events = Event::all();
        $filteredEvents = $events
            ->unique(fn($event) => $event->message)
            ->filter(fn($event) => !is_null($event->subject))
            ->map(fn($event) => $this->extractData($event))
            ->values();
        info($filteredEvents);

        return view('example5');
    }

    private function extractData(Event $event): array
    {
        return [
            'label' => ucwords($event->subject),
            'message' => [
                'success' => $event->status !== 'error',
                'message' => $event->message
            ]
        ];
    }

    public function example6()
    {
        // Creating 10 temporary files for the test
        $f = fopen(storage_path('logs/demo/laravel.log'), 'w');
        fclose($f);
        for ($day=0; $day < 10; $day++) {
            $date = now()->subDays($day)->toDateString();
            $f = fopen(storage_path('logs/demo/laravel-' . $date . '.log'), 'w');
            fclose($f);
        }

        $thresholdDate = now()->subDays(3)->setTime(0, 0, 0, 0);

        $files = Storage::disk("logs")->allFiles();
        $logFiles = collect($files)
            ->mapWithKeys(function ($file) {
                $matches = [];
                $isMatch = preg_match("/^laravel\-(.*)\.log$/i", $file, $matches);

                if (count($matches) > 1) {
                    $date = $matches[1];
                }

                $key = $isMatch ? $date : "";
                return [$key => $file];
            })
            ->forget("")
            ->filter(function ($value, $key) use ($thresholdDate) {
                try {
                    $date = Carbon::parse($key);
                } catch (\Exception $e) {
                    return true;
                }

                return $date->isBefore($thresholdDate);
            });
        info($logFiles);

        return view('example6');
    }

    public function example7()
    {
        $comment = Comment::first();
        collect($comment->mentionedUsers())
            ->map(function ($name) {
                return User::where('name', $name)->first();
            })
            ->filter()
            ->each(function ($user) use ($comment) {
                $user->notify(new YouWereMentionedNotification($comment));
            });

        return view('example7');
    }

    public function mentionedUsers($commentText)
    {
        preg_match_all('/@([\w\-]+)/', $commentText, $matches);

        return $matches[1];
    }

}
