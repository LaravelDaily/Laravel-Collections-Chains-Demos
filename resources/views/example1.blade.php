<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 1: map + implode') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Code</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
$role = Role::with('permissions')->first();
$permissionsListToShow = $role->permissions
    ->map(function ($permission) {
        return $permission->name;
    })
    ->implode("&lt;br&gt;");
                    </pre>
                    <hr />
                    <div class="mt-4 mb-4">
                    Initial value of <b>$role->permissions</b>:
                    <br />
                    @php dump($role->permissions) @endphp
                    </div>
                    <hr />
                    <div class="mt-4 mb-4">
                        Value after <b>map()</b>:
                        <br />
                        @php dump($role->permissions
    ->map(function ($permission) {
        return $permission->name;
    })  ) @endphp
                    </div>
                    <hr />
                    <div class="mt-4 mb-4">
                    Value after <b>map()->implode()</b>:
                    <br />
                    @php dump($permissionsListToShow) @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
