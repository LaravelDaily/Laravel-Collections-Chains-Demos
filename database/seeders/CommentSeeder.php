<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['name' => 'First']);
        User::factory()->create(['name' => 'Second']);

        Comment::create([
            'description' => 'I mention the @First user and the @Second user and @Third non-existing one.'
        ]);
    }
}
