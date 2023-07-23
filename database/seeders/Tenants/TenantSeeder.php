<?php

namespace Database\Seeders\Tenants;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'name2', 'email' => fake()->email(), 'password' => 'password2'
            ],
            [
                'name' => 'name2', 'email' => fake()->email(), 'password' => 'password2'
            ]
        ];

        User::insert($data);
    }
}
