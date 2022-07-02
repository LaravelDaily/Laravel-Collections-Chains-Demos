<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 8: map + mapToGroups + map + each') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <b>Task</b>: get all Laravel version numbers from GitHub and update major/minor versions in local DB.
                    </div>
                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Code</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
$versionsFromGithub = collect([
    ['name' => 'v9.19.0'],
    ['name' => 'v8.83.18'],
    ['name' => 'v9.18.0'],
    ['name' => 'v8.83.17'],
    ['name' => 'v9.17.0'],
    ['name' => 'v8.83.16'],
    // ...
]);

$versionsFromGithub
    // Map into arrays containing major, minor, and patch numbers
    ->map(function ($item) {
        $pieces = explode('.', ltrim($item['name'], 'v'));

        return [
            'major' => $pieces[0],
            'minor' => $pieces[1],
            'patch' => $pieces[2] ?? null,
        ];
    })
    // Map into groups by release; pre-6, major/minor pair; post-6, major
    ->mapToGroups(function ($item) {
        if ($item['major'] < 6) {
            return [$item['major'] . '.' . $item['minor'] => $item];
        }

        return [$item['major'] => $item];
    })
    // Take the highest patch or minor/patch number from each release
    ->map(function ($item) {
        if ($item->first()['major'] < 6) {
            // Take the highest patch
            return $item->sortByDesc('patch')->first();
        }

        // Take the highest minor, then its highest patch
        return $item->sortBy([['minor', 'desc'], ['patch', 'desc']])->first();
    })
    ->each(function ($item) {
        if ($item['major'] < 6) {
            $version = LaravelVersion::where([
                'major' => $item['major'],
                'minor' => $item['minor'],
            ])->first();

            if ($version->patch < $item['patch']) {
                $version->update(['patch' => $item['patch']]);
                info('Updated Laravel version ' . $version . ' to use latest patch.');
            }
        }

        $version = LaravelVersion::where([
            'major' => $item['major'],
        ])->first();

        if (! $version) {
            // Create it if it doesn't exist
            $created = LaravelVersion::create([
                'major' => $item['major'],
                'minor' => $item['minor'],
                'patch' => $item['patch'],
            ]);

            info('Created Laravel version ' . $created);
        }
        // Update the minor and patch if needed
        else if ($version->minor != $item['minor'] || $version->patch != $item['patch']) {
            $version->update(['minor' => $item['minor'], 'patch' => $item['patch']]);
            info('Updated Laravel version ' . $version . ' to use latest minor/patch.');
        }
    });
                    </pre>
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Initial value of <b>$versionsFromGithub</b>:
                        <br/>
                        @php dump(collect([
            ['name' => 'v9.19.0'],
            ['name' => 'v8.83.18'],
            ['name' => 'v9.18.0'],
            ['name' => 'v8.83.17'],
            ['name' => 'v9.17.0'],
            ['name' => 'v8.83.16'],
        ])) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()</b>:
                        <br/>
                        @php dump(collect([
            ['name' => 'v9.19.0'],
            ['name' => 'v8.83.18'],
            ['name' => 'v9.18.0'],
            ['name' => 'v8.83.17'],
            ['name' => 'v9.17.0'],
            ['name' => 'v8.83.16'],
        ])->map(function ($item) {
                $pieces = explode('.', ltrim($item['name'], 'v'));

                return [
                    'major' => $pieces[0],
                    'minor' => $pieces[1],
                    'patch' => $pieces[2] ?? null,
                ];
            })) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()->mapToGroups()</b>:
                        <br/>
                        @php dump(collect([
            ['name' => 'v9.19.0'],
            ['name' => 'v8.83.18'],
            ['name' => 'v9.18.0'],
            ['name' => 'v8.83.17'],
            ['name' => 'v9.17.0'],
            ['name' => 'v8.83.16'],
        ])->map(function ($item) {
                $pieces = explode('.', ltrim($item['name'], 'v'));

                return [
                    'major' => $pieces[0],
                    'minor' => $pieces[1],
                    'patch' => $pieces[2] ?? null,
                ];
            })->mapToGroups(function ($item) {
                if ($item['major'] < 6) {
                    return [$item['major'] . '.' . $item['minor'] => $item];
                }

                return [$item['major'] => $item];
            })) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()->mapToGroups()->map()</b>:
                        <br/>
                        @php dump(collect([
            ['name' => 'v9.19.0'],
            ['name' => 'v8.83.18'],
            ['name' => 'v9.18.0'],
            ['name' => 'v8.83.17'],
            ['name' => 'v9.17.0'],
            ['name' => 'v8.83.16'],
        ])->map(function ($item) {
                $pieces = explode('.', ltrim($item['name'], 'v'));

                return [
                    'major' => $pieces[0],
                    'minor' => $pieces[1],
                    'patch' => $pieces[2] ?? null,
                ];
            })->mapToGroups(function ($item) {
                if ($item['major'] < 6) {
                    return [$item['major'] . '.' . $item['minor'] => $item];
                }

                return [$item['major'] => $item];
            })->map(function ($item) {
                if ($item->first()['major'] < 6) {
                    // Take the highest patch
                    return $item->sortByDesc('patch')->first();
                }

                // Take the highest minor, then its highest patch
                return $item->sortBy([['minor', 'desc'], ['patch', 'desc']])->first();
            })) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/tighten/laravelversions/blob/main/app/Console/Commands/FetchLatestReleaseNumbers.php">tighten/laravelversions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
