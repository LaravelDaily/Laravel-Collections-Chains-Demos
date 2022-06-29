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
    ->map(fn($permission) => $permission->name)
    ->implode("&lt;br&gt;");
                    </pre>
                    <hr/>
                    <div class="mt-4 mb-4">
                        Initial value of <b>$role->permissions</b>:
                        <br/>
                        @php dump(\App\Models\Role::with('permissions')->first()->permissions) @endphp
                    </div>
                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()</b>:
                        <br/>
                        @php dump(\App\Models\Role::with('permissions')->first()->permissions->map(fn($permission) => $permission->name)  ) @endphp
                    </div>
                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()->implode()</b>:
                        <br/>
                        @php dump(\App\Models\Role::with('permissions')->first()->permissions
    ->map(fn($permission) => $permission->name)->implode("<br>")  ) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/Bottelet/DaybydayCRM/blob/a5719a23bdc2e29e021e86b97a1116ed1fd683c2/app/Http/Controllers/RolesController.php">Bottelet/DaybydayCRM</a>
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        <b>Alternative - with arrays:</b>
                        <pre class="bg-gray-100 p-2 mb-4">
$permissionsArrayToShow = [];
foreach ($role->permissions as $permission) {
    $permissionsArrayToShow[] = $permission->name;
}
$permissionsListToShow = implode("&lt;br&gt;", $permissionsArrayToShow);
                    </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
