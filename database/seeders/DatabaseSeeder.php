<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $serives = [
            [
                'name' => 'block list user',
                'description' => ' this service benfits in block user ',
                'price' => 100,
                'duration' => 1,
            ],
            [
                'name' => ' mutliple images ',
                'description' => ' this service benfits in upload mutliple images for user',
                'price' => 200,
                'duration' => 1,
            ],

        ];

        Service::insert($serives);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
