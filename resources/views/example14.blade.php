<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 14: map + flatten + map + filter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <b>Task</b>: get all Livewire component files from two folders and return their classnames.
                    </div>
                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Code</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
$folders = collect([
    "/Users/someuser/Sites/project3/app/Base/Http/Livewire/",
    "/Users/someuser/Sites/project3/app/Project/Livewire/"
]);

$classNames = $folders
    ->map(function ($item) {
        return (new Filesystem())->allFiles($item);
    })
    ->flatten()
    ->map(function (\SplFileInfo $file) {
        return app()->getNamespace().str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($file->getPathname(), app_path().'/')
            );
    })
    ->filter(function (string $class) {
        return is_subclass_of($class, Component::class) &&
            ! (new \ReflectionClass($class))->isAbstract();
    });</pre>
                    </div>
                    @php
                        $folders = collect([
                            "/Users/povilaskorop/Sites/project3/app/Base/Http/Livewire/",
                            "/Users/povilaskorop/Sites/project3/app/Project/Livewire/"
                        ]);
                    @endphp

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()</b>:
                        <br/>
                        @php dump($folders->map(function ($item) {
        return (new \Illuminate\Filesystem\Filesystem())->allFiles($item);
    })) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()->flatten()</b>:
                        <br/>
                        @php dump($folders->map(function ($item) {
        return (new \Illuminate\Filesystem\Filesystem())->allFiles($item);
    })->flatten()) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()->flatten()->map()</b>:
                        <br/>
                        @php dump($folders->map(function ($item) {
        return (new \Illuminate\Filesystem\Filesystem())->allFiles($item);
    })->flatten()->map(function (\SplFileInfo $file) {
                return app()->getNamespace().str_replace(
                        ['/', '.php'],
                        ['\\', ''],
                        \Illuminate\Support\Str::after($file->getPathname(), app_path().'/')
                    );
            })) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()->flatten()->map()->filter()</b>:
                        <br/>
                        @php dump($folders->map(function ($item) {
        return (new \Illuminate\Filesystem\Filesystem())->allFiles($item);
    })->flatten()->map(function (\SplFileInfo $file) {
                return app()->getNamespace().str_replace(
                        ['/', '.php'],
                        ['\\', ''],
                        \Illuminate\Support\Str::after($file->getPathname(), app_path().'/')
                    );
            })->filter(function (string $class) {
                return is_subclass_of($class, \Livewire\Component::class) &&
                    ! (new \ReflectionClass($class))->isAbstract();
            })) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/iluminar/goodwork/blob/master/app/Base/Utilities/ExtendedLivewireComponentsFinder.php">iluminar/goodwork</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
