<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 2: push + map + implode') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Code of Artisan command</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
$excluded = collect($this->option('exclude'))
    ->push('povilaskorop', '@dailylaravel')
    ->map(fn (string $name): string => str_replace('@', '', $name))
    ->implode(', ');
                    </pre>

                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Call with parameters</b>
                    <pre class="bg-gray-100 p-2 mb-4">
php artisan twitter:giveaway --exclude=someuser --exclude=@otheruser</pre>
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Initial value of <b>collect($this->option('exclude'))</b>:
                        <br />
                        @php dump(collect(['someuser', '@otheruser'])) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Value after <b>push()</b>:
                        <br />
                        @php dump(collect(['someuser', '@otheruser'])->push('povilaskorop', '@dailylaravel')) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Value after <b>push()->map()</b>:
                        <br />
                        @php dump(collect(['someuser', '@otheruser'])->push('povilaskorop', '@dailylaravel')->map(fn (string $name): string => str_replace('@', '', $name))) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Value after <b>push()->map()->implode()</b>:
                        <br />
                        @php dump(collect(['someuser', '@otheruser'])->push('povilaskorop', '@dailylaravel')->map(fn (string $name): string => str_replace('@', '', $name))->implode(', ')) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/Gummibeer/gummibeer.de/blob/master/app/Console/Commands/TwitterGiveaway.php">Gummibeer/gummibeer.de</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
