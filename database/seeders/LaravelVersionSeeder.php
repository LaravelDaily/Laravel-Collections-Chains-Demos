<?php

namespace Database\Seeders;

use App\Models\LaravelVersion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaravelVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LaravelVersion::create([
            'major' => 9,
            'minor' => 18,
        ]);
    }
}
