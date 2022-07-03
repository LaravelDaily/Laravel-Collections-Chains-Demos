<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = Post::create([
            'type' => 'tweet',
            'title' => 'First tweet with empty external url',
            'text' => '<blockquote class="twitter-tweet"><p lang="en" dir="ltr">🔥 Laravel quick tip<br><br>Use -&gt;map-&gt;only on Eloquent collections to pluck multiple attributes <a href="https://t.co/z3c1sOox9J">pic.twitter.com/z3c1sOox9J</a></p>&mdash; Sebastian De Deyne (@sebdedeyne) <a href="https://twitter.com/sebdedeyne/status/1130875746577264642?ref_src=twsrc%5Etfw">May 21, 2019</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>',
        ]);
        $post->tags()->attach(1);

        $post = Post::create([
            'type' => 'tweet',
            'title' => 'Second tweet with non-empty external url',
            'text' => '<blockquote class="twitter-tweet"><p lang="en" dir="ltr">🔥 Laravel quick tip<br><br>Use -&gt;map-&gt;only on Eloquent collections to pluck multiple attributes <a href="https://t.co/z3c1sOox9J">pic.twitter.com/z3c1sOox9J</a></p>&mdash; Sebastian De Deyne (@sebdedeyne) <a href="https://twitter.com/sebdedeyne/status/1130875746577264642?ref_src=twsrc%5Etfw">May 21, 2019</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>',
            'external_url' => 'https://twitter.com/sebdedeyne/status/1130875746577264642?ref_src=twsrc%5Etfw',
        ]);
        $post->tags()->attach(1);

        Post::create([
            'type' => 'original',
            'title' => 'Some title',
            'text' => 'Some text',
        ]);
    }
}
