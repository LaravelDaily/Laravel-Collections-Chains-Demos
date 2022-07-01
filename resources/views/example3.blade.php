<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 3: filter + map + implode') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                    <b>Task</b>: you have a User model with links to social network profiles: Twitter, Facebook, Instagram. Some of them may be empty.
                    <br />
                    Your goal is to show non-empty links, separated by | symbol.
                    </div>
                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Code snippet</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
$socialLinks = collect([
    'Twitter' => $user->link_twitter,
    'Facebook' => $user->link_facebook,
    'Instagram' => $user->link_instagram,
])
->filter()
->map(fn ($link, $network) => '&lt;a href="' . $link . '"&gt;' . $network . '&lt;/a&gt;')
->implode(' | ');
                    </pre>

                    <hr />

                    <div class="mt-4 mb-4">
                        Initial value of <b>collect()</b>:
                        <br />
                        @php dump(collect([
    'Twitter' => $user->link_twitter,
    'Facebook' => $user->link_facebook,
    'Instagram' => $user->link_instagram,
])) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Value after <b>filter()</b>:
                        <br />
                        @php dump(collect([
    'Twitter' => $user->link_twitter,
    'Facebook' => $user->link_facebook,
    'Instagram' => $user->link_instagram,
])->filter()) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Value after <b>filter()->map()</b>:
                        <br />
                        @php dump(collect([
    'Twitter' => $user->link_twitter,
    'Facebook' => $user->link_facebook,
    'Instagram' => $user->link_instagram,
])->filter()->map(fn ($link, $network) => '<a href="' . $link . '">' . $network . '</a>')) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Value after <b>filter()->map()->implode()</b>:
                        <br />
                        @php dump(collect([
    'Twitter' => $user->link_twitter,
    'Facebook' => $user->link_facebook,
    'Instagram' => $user->link_instagram,
])->filter()->map(fn ($link, $network) => '<a href="' . $link . '">' . $network . '</a>')->implode(' | ')) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/spatie/freek.dev/blob/14a25e3b7f7c7d662e61746a9c24d28b9ac316b9/app/Models/Presenters/TalkPresenter.php">spatie/freek.dev</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
