<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Example 13: filter + filter + each') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <b>Task</b>: get all posts with empty external URL and fill it in from the post body.
                    </div>
                    <hr />

                    <div class="mt-4 mb-4">
                    <b>Code</b>:
                    <pre class="bg-gray-100 p-2 mb-4">
Post::all()
    ->filter->isTweet()
    ->filter(function (Post $post) {
        return empty($post->external_url);
    })
    ->each(function (Post $post) {
        preg_match('/(?=https:\/\/twitter.com\/).+?(?=")/', $post->text, $matches);

        if (count($matches) > 0) {
            $post->external_url = $matches[0];
            $post->save();
        }
    });</pre>
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Initial value of <b>Post::all()</b>:
                        <br/>
                        @php dump(\App\Models\Post::all()) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>filter()</b>:
                        <br/>
                        @php dump(\App\Models\Post::all()->filter->isTweet()) @endphp
                    </div>

                    <hr/>
                    <div class="mt-4 mb-4">
                        Value after <b>filter()->filter()</b>:
                        <br/>
                        @php dump(\App\Models\Post::all()->filter->isTweet()->filter(function (\App\Models\Post $post) {
        return empty($post->external_url);
    })) @endphp
                    </div>

                    <hr />
                    <div class="mt-4 mb-4">
                        Inspiration source: <a class="underline" href="https://github.com/spatie/freek.dev/blob/main/app/Console/Commands/UpdateExternalUrlsWithTweetPermalinksCommand.php">spatie/freek.dev</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
