<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'subject' => 'Success!',
            'message' => 'Success message',
            'status' => 'success'
        ]);
        Event::create([
            'subject' => 'Another Success!',
            'message' => 'Success message', // duplicate for unique()
            'status' => 'success'
        ]);
        Event::create([
            'subject' => 'Failure!',
            'message' => 'Error message',
            'status' => 'error'
        ]);
        Event::create([
            // no subject
            'message' => 'Some random message',
            'status' => 'unknown'
        ]);
    }
}
