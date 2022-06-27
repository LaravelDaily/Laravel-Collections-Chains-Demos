<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organization = Organization::create(['name' => 'Microsoft']);
        User::factory()->create([
            'organization_id' => $organization->id
        ]);

        $organization = Organization::create(['name' => 'Google']);
        User::factory()->create([
            'organization_id' => $organization->id,
            'github_access_token' => 'some_token_secret',
            'registered_at' => now()
        ]);

        Organization::create(['name' => 'Apple']);
    }
}
