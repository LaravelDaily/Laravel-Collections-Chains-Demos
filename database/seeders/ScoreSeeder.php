<?php

namespace Database\Seeders;

use App\Models\Score;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Score::create(['field' => 'NoGS']);
        Score::create(['field' => 'BM-2']);
        Score::create(['field' => 'LT-1']);
    }
}
