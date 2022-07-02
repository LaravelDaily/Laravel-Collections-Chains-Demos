<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 5: unique + filter + map + values') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-4 mb-4">
                    <b>Code snippet</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
$events = Event::all();
$filteredEvents = $events
    ->unique(fn ($event) => $event->message)
    ->filter(fn ($event) => !is_null($event->subject))
    ->map(fn ($event) => $this->extractData($event))
    ->values();
                    </pre>

                    <hr />

                    <div class="mt-4 mb-4">
                        Initial value of <b>Event::all()</b>:
                        <br />
                        @php dump(\App\Models\Event::all()) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Value after first <b>unique()</b>:
                        <br />
                        @php dump(\App\Models\Event::all()->unique(fn ($event) => $event->message)) @endphp
                    </div>

                        <hr />
                        <div class="mt-4 mb-4">
                            Value after <b>->unique()->filter()</b>:
                            <br />
                            @php dump(\App\Models\Event::all()->unique(fn ($event) => $event->message)->filter(fn ($event) => !is_null($event->subject))) @endphp
                        </div>

                        <hr />
                        <div class="mt-4 mb-4">
                            Value after <b>->unique()->filter()->map()</b>:
                            <br />
                            @php dump(\App\Models\Event::all()->unique(fn ($event) => $event->message)->filter(fn ($event) => !is_null($event->subject))->map(fn ($event) => [
            'label' => ucwords($event->subject),
            'message' => [
                'success' => $event->status !== 'error',
                'message' => $event->message
            ]
        ])) @endphp
                        </div>

                        <hr />
                        <div class="mt-4 mb-4">
                            Value after <b>->unique()->filter()->map()->values()</b>:
                            <br />
                            @php dump(\App\Models\Event::all()->unique(fn ($event) => $event->message)->filter(fn ($event) => !is_null($event->subject))->map(fn ($event) => [
            'label' => ucwords($event->subject),
            'message' => [
                'success' => $event->status !== 'error',
                'message' => $event->message
            ]
        ])->values()) @endphp
                        </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/opendialogai/opendialog/blob/f7497ad94c21dfd78600e1a509f01067aaa0d323/app/Http/Responses/SelectionFrame.php">opendialogai/opendialog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
