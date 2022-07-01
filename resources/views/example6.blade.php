<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 6: mapWithKeys + forget + filter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <b>Task</b>: read all the "laravel-[date].log" files from storage/logs and identify older ones than X days.
                    </div>
                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Code</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
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
                    </pre>
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Initial value of <b>collect($files)</b>:
                        <br/>
                        @php dump(collect(\Illuminate\Support\Facades\Storage::disk("logs")->allFiles())) @endphp
                    </div>
                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>mapWithKeys()</b>:
                        <br/>
                        @php dump(collect(\Illuminate\Support\Facades\Storage::disk("logs")->allFiles())->mapWithKeys(function ($file) {
        $matches = [];
        $isMatch = preg_match("/^laravel\-(.*)\.log$/i", $file, $matches);

        if (count($matches) > 1) {
            $date = $matches[1];
        }

        $key = $isMatch ? $date : "";
        return [$key => $file];
    })) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>mapWithKeys()->forget()</b>:
                        <br/>
                        @php dump(collect(\Illuminate\Support\Facades\Storage::disk("logs")->allFiles())->mapWithKeys(function ($file) {
        $matches = [];
        $isMatch = preg_match("/^laravel\-(.*)\.log$/i", $file, $matches);

        if (count($matches) > 1) {
            $date = $matches[1];
        }

        $key = $isMatch ? $date : "";
        return [$key => $file];
    })->forget("")) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>mapWithKeys()->forget()->filter()</b>:
                        <br/>
                        @php dump(collect(\Illuminate\Support\Facades\Storage::disk("logs")->allFiles())->mapWithKeys(function ($file) {
        $matches = [];
        $isMatch = preg_match("/^laravel\-(.*)\.log$/i", $file, $matches);

        if (count($matches) > 1) {
            $date = $matches[1];
        }

        $key = $isMatch ? $date : "";
        return [$key => $file];
    })->forget("")->filter(function ($value, $key) {
        try {
            $date = \Carbon\Carbon::parse($key);
        } catch (\Exception $e) {
            return true;
        }

        return $date->isBefore(now()->subDays(3)->setTime(0, 0, 0, 0));
    })) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/opendialogai/opendialog/blob/1.x/app/Console/Commands/ClearLogs.php">opendialogai/opendialog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
