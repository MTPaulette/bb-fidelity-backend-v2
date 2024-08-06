<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* role */
        \App\Models\Role::factory()->create([
            'name' => 'administrator'
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'client'
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'superadmin'
        ]);
    }
}
