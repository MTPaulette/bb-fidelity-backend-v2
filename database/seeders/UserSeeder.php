<?php

namespace Database\Seeders;

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

        \App\Models\User::factory()->create([
            'name' => 'sample user',
            'email' => 'user@test.fr',
            'role_id' => 2,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'booster',
            'email' => 'booster@test.fr',
            'role_id' => 1,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'brain',
            'email' => 'brain@test.fr',
            'role_id' => 1,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Brain booster',
            'email' => 'brain-booster@test.fr',
            'role_id' => 3,
        ]);
    }
}
