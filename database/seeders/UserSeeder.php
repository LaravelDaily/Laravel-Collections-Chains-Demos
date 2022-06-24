<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'link_twitter' => 'https://twitter.com/povilaskorop',
            'link_facebook' => '',
            'link_instagram' => 'https://instagram.com/povilaskorop',
        ]);
    }
}
