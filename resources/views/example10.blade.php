<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 10: filter + first & map + implode') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <b>Task</b>: identify the path of current classname and transform it to lowercase with dots as separator.
                    </div>
                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Code</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
$class = 'App\\Base\\Http\\Livewire\\SomeClass';
$classNamespaces = [
    'App\\Base\\Http\\Livewire',
    'App\\Project\\Livewire'
];

$classNamespace = collect($classNamespaces)->filter(fn ($x) => strpos($class, $x) !== false)->first();
$namespace = collect(explode('.', str_replace(['/', '\\'], '.', $classNamespace)))
    ->map([Str::class, 'kebab'])
    ->implode('.');</pre>
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>filter()</b>:
                        <br/>
                        @php dump(collect([
    'App\\Base\\Http\\Livewire',
    'App\\Project\\Livewire'
])->filter(fn ($x) => strpos('App\\Base\\Http\\Livewire\\SomeClass', $x) !== false)) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>filter()->first()</b>:
                        <br/>
                        @php dump(collect([
    'App\\Base\\Http\\Livewire',
    'App\\Project\\Livewire'
])->filter(fn ($x) => strpos('App\\Base\\Http\\Livewire\\SomeClass', $x) !== false)->first()) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>filter()->first()->map()</b>:
                        <br/>
                        @php dump(collect(explode('.', str_replace(['/', '\\'], '.', collect([
    'App\\Base\\Http\\Livewire',
    'App\\Project\\Livewire'
])->filter(fn ($x) => strpos('App\\Base\\Http\\Livewire\\SomeClass', $x) !== false)->first())))->map([Str::class, 'kebab'])) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>filter()->first()->map()->implode()</b>:
                        <br/>
                        @php dump(collect(explode('.', str_replace(['/', '\\'], '.', collect([
    'App\\Base\\Http\\Livewire',
    'App\\Project\\Livewire'
])->filter(fn ($x) => strpos('App\\Base\\Http\\Livewire\\SomeClass', $x) !== false)->first())))->map([Str::class, 'kebab'])->implode('.')) @endphp
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
