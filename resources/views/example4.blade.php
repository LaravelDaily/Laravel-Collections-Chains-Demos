<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 4: reject + reject + each') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                    <b>Task</b>: you have a list of Models. You need to filter some objects out by some relationship condition, and then perform some job on each of them.
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                    <b>Code snippet</b>:
                    <pre class="bg-gray-100 p-2 mb-4 text-sm">
Repository::query()
    ->with('owner')
    ->get()
    ->reject(function (Repository $repository): bool {
        return $repository->owner instanceof User && $repository->owner->github_access_token === null;
    })
    ->reject(function (Repository $repository): bool {
        return $repository->owner instanceof Organization && $repository->owner->members()->whereIsRegistered()->doesntExist();
    })
    ->each(static function (Repository $repository): void {
        UpdateRepositoryDetails::dispatch($repository);
    });
                    </pre>

                    <hr />

                    <div class="mt-4 mb-4">
                        Initial value of <b>Repository::query()->with('owner')->get()</b>:
                        <br />
                        @php dump(\App\Models\Repository::query()
    ->with('owner')
    ->get()) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Value after first <b>reject()</b>:
                        <br />
                        @php dump(\App\Models\Repository::query()
    ->with('owner')
    ->get()
    ->reject(function (\App\Models\Repository $repository): bool {
        return $repository->owner instanceof \App\Models\User && $repository->owner->github_access_token === null;
    })) @endphp
                    </div>

                        <hr />
                        <div class="mt-4 mb-4">
                            Value after second <b>reject()</b>:
                            <br />
                            @php dump(\App\Models\Repository::query()
    ->with('owner')
    ->get()
    ->reject(function (\App\Models\Repository $repository): bool {
        return $repository->owner instanceof \App\Models\User && $repository->owner->github_access_token === null;
    })->reject(function (\App\Models\Repository $repository): bool {
        return $repository->owner instanceof \App\Models\Organization
            && $repository->owner->members()
                ->whereNotNull('github_access_token')
                ->whereNotNull('registered_at')
                ->doesntExist();
    }))
                            @endphp
                        </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/Astrotomic/opendor.me/blob/dev/app/Console/Commands/GithubRepositoryDetails.php">Astrotomic/opendor.me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
