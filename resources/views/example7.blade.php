<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 7: map + filter + each') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <b>Task</b>: get all users mentioned in the comment text with @username syntax, and send notifications to them.
                    </div>
                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Code</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
$comment = Comment::first();
collect($comment->mentionedUsers())
    ->map(function ($name) {
        return User::where('name', $name)->first();
    })
    ->filter()
    ->each(function ($user) use ($comment) {
        $user->notify(new YouWereMentionedNotification($comment));
    });
                    </pre>
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Initial value of <b>$comment->description</b>:
                        <br/>
                        @php dump(\App\Models\Comment::first()->description) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Initial value of <b>$comment->mentionedUsers()</b>:
                        <br/>
                        @php dump(collect(\App\Models\Comment::first()->mentionedUsers())) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()</b>:
                        <br/>
                        @php dump(collect(\App\Models\Comment::first()->mentionedUsers())->map(function ($name) {
        return \App\Models\User::where('name', $name)->first();
    })) @endphp
                    </div>
                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>map()->filter()</b>:
                        <br/>
                        @php dump(collect(\App\Models\Comment::first()->mentionedUsers())->map(function ($name) {
        return \App\Models\User::where('name', $name)->first();
    })->filter()) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/Bottelet/DaybydayCRM/blob/d1965973f60933fd293aaaaa9f71e9d27edfd819/app/Listeners/NotiftyMentionedUsers.php">Bottelet/DaybydayCRM</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
