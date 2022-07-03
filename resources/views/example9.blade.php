<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 9: map + filter + implode') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <b>Task</b>: get the list of "ancestor" categories and build the full URL path from their slugs.
                    </div>
                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Code</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
$locale = 'en';
Category::all()
    ->map(function ($i) use ($locale) { return $i->getSlug($locale); })
    ->filter()
    ->implode('/');</pre>
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Initial value of <b>Category::all()</b>:
                        <br/>
                        @php dump(\App\Models\Category::all()) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()</b>:
                        <br/>
                        @php dump(\App\Models\Category::all()->map(function ($i) { return $i->getSlug('en'); })) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()->filter()</b>:
                        <br/>
                        @php dump(\App\Models\Category::all()->map(function ($i) { return $i->getSlug('en'); })->filter()) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()->filter()->implode()</b>:
                        <br/>
                        @php dump(\App\Models\Category::all()->map(function ($i) { return $i->getSlug('en'); })->filter()->implode('/')) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/area17/twill/blob/2.x/src/Models/Behaviors/HasNesting.php">area17/twill</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
