<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 15: mapWithKeys + each + reject + filter + all') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <b>Task</b>: get all installed vendor packages and extract only Laravel packages into array.
                    </div>
                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Code</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
if ($filesystem->exists($path = base_path() . '/vendor/composer/installed.json')) {
    $plugins = json_decode($filesystem->get($path), true);
}

$packages = collect($plugins['packages'])
    ->mapWithKeys(function ($package) {
        return [$this->format($package['name']) => $package['extra']['laravel'] ?? []];
    })
    ->each(function ($configuration) use (&$ignore) {
        $ignore = array_merge($ignore, $configuration['dont-discover'] ?? []);
    })
    ->reject(function ($configuration, $package) use ($ignore) {
        return in_array($package, $ignore);
    })
    ->filter()
    ->all();</pre>
                    </div>
                    @php
                        $filesystem = new \Illuminate\Filesystem\Filesystem();
                        if ($filesystem->exists($path = base_path() . '/vendor/composer/installed.json')) {
                            $plugins = json_decode($filesystem->get($path), true);
                        }

                        function format($package)
                        {
                            return str_replace('vendor/', '', $package);
                        }

                        $ignore = ['nesbot/carbon'];
                    @endphp

                    <hr/>
                    <div class="mt-4 mb-4">
                        Initial value of <b>$plugins['packages']</b>:
                        <br/>
                        @php dump($plugins['packages']) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>mapWithKeys()</b>:
                        <br/>
                        @php dump(collect($plugins['packages'])
    ->mapWithKeys(function ($package) {
        return [format($package['name']) => $package['extra']['laravel'] ?? []];
    })) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>mapWithKeys()->each()->reject()</b>:
                        <br/>
                        @php dump(collect($plugins['packages'])
    ->mapWithKeys(function ($package) {
        return [format($package['name']) => $package['extra']['laravel'] ?? []];
    })->each(function ($configuration) use (&$ignore) {
                $ignore = array_merge($ignore, $configuration['dont-discover'] ?? []);
            })
            ->reject(function ($configuration, $package) use ($ignore) {
                return in_array($package, $ignore);
            })) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>mapWithKeys()->each()->reject()->filter()</b>:
                        <br/>
                        @php dump(collect($plugins['packages'])
    ->mapWithKeys(function ($package) {
        return [format($package['name']) => $package['extra']['laravel'] ?? []];
    })->each(function ($configuration) use (&$ignore) {
                $ignore = array_merge($ignore, $configuration['dont-discover'] ?? []);
            })
            ->reject(function ($configuration, $package) use ($ignore) {
                return in_array($package, $ignore);
            })->filter()) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>mapWithKeys()->each()->reject()->filter()->all()</b>:
                        <br/>
                        @php dump(collect($plugins['packages'])
    ->mapWithKeys(function ($package) {
        return [format($package['name']) => $package['extra']['laravel'] ?? []];
    })->each(function ($configuration) use (&$ignore) {
                $ignore = array_merge($ignore, $configuration['dont-discover'] ?? []);
            })
            ->reject(function ($configuration, $package) use ($ignore) {
                return in_array($package, $ignore);
            })->filter()->all()) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/iluminar/goodwork/blob/92e685c8bc0ce954ff4ff4d72a7c90a2b38d0415/app/Base/Utilities/PluginManifest.php#L43">iluminar/goodwork</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
