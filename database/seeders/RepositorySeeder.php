<?php

namespace Database\Seeders;

use App\Models\Repository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepositorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Repository::create([
            'name' => 'First repository',
            'owner_id' => 1,
            'owner_type' => 'App\Models\User'
        ]);

        Repository::create([
            'name' => 'Second repository',
            'owner_id' => 1,
            'owner_type' => 'App\Models\Organization'
        ]);

        Repository::create([
            'name' => 'Third repository',
            'owner_id' => 2,
            'owner_type' => 'App\Models\Organization'
        ]);
    }
}
