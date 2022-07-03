<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 11: map + max') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <b>Task</b>: find the key of array by items, with maximum value.
                    </div>
                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Code</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
$hazards = [
    'BM-1'   => 8,
    'LT-1'   => 7,
    'LT-P1'  => 6,
    'LT-UNK' => 5,
    'BM-2'   => 4,
    'BM-3'   => 3,
    'BM-4'   => 2,
    'BM-U'   => 1,
    'NoGS'   => 0,
    'Not Screened' => 0,
];

$score = Score::all()->map(function($item) use ($hazards) {
    return $hazards[$item->field];
})->max();</pre>
                        @php
                            $hazards = [
                                'BM-1'   => 8,
                                'LT-1'   => 7,
                                'LT-P1'  => 6,
                                'LT-UNK' => 5,
                                'BM-2'   => 4,
                                'BM-3'   => 3,
                                'BM-4'   => 2,
                                'BM-U'   => 1,
                                'NoGS'   => 0,
                                'Not Screened' => 0,
                            ];
                        @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Initial value of <b>Score::all()</b>:
                        <br/>
                        @php dump(\App\Models\Score::all()) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()</b>:
                        <br/>
                        @php dump(\App\Models\Score::all()->map(function($item) use ($hazards) {
    return $hazards[$item->field];
})) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()->max()</b>:
                        <br/>
                        @php dump(\App\Models\Score::all()->map(function($item) use ($hazards) {
    return $hazards[$item->field];
})->max()) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://laracasts.com/discuss/channels/laravel/collection-filter-by-array?page=1&replyId=643471">Laracasts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
