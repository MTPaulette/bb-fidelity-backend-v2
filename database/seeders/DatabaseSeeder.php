<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        /* role */
        \App\Models\Role::factory()->create([
            'name' => 'administrator'
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'client'
        ]);

        /* user */
        \App\Models\User::factory()->create([
            'name' => 'Brain booster',
            'email' => 'booster@test.fr',
            'role_id' => 1,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'sample user',
            'email' => 'user@test.fr'
        ]);
       \App\Models\User::factory(10)->create();

        

        /* service */
        \App\Models\Service::factory(15)->create();

        /* service user */
        $u10 = \App\Models\User::find(10);
        $u2 = \App\Models\User::find(2);
        $u3 = \App\Models\User::find(3);
        $u7 = \App\Models\User::find(7);
        $u6 = \App\Models\User::find(6);
        $u11 = \App\Models\User::find(11);

        $s1 = \App\Models\Service::find(1);
        $s2 = \App\Models\Service::find(2);
        $s3 = \App\Models\Service::find(3);
        $s7 = \App\Models\Service::find(7);
        $s8 = \App\Models\Service::find(8);
        $s9 = \App\Models\Service::find(9);
        $s10 = \App\Models\Service::find(10);
        $s12 = \App\Models\Service::find(12);
        $s13 = \App\Models\Service::find(13);

        $u10->services()->attach($s1, ['by_cash' => true, 'bonus_point' => '50', 'user_balance' => '400', 'admin_id' => '1']);
        $u3->services()->attach($s1, ['by_cash' => true, 'bonus_point' => '30', 'user_balance' => '70', 'admin_id' => '1']);
        $u10->services()->attach($s3, ['by_cash' => true, 'bonus_point' => '10', 'user_balance' => '130', 'admin_id' => '1']);
        $u2->services()->attach($s2, ['by_cash' => false, 'bonus_point' => '0', 'user_balance' => '800', 'admin_id' => '1']);

        $u7->services()->attach($s7, ['by_cash' => false, 'bonus_point' => '0', 'user_balance' => '350', 'admin_id' => '1']);
        $u7->services()->attach($s8, ['by_cash' => false, 'bonus_point' => '0', 'user_balance' => '30', 'admin_id' => '1']);
        $u7->services()->attach($s9, ['by_cash' => true, 'bonus_point' => '70', 'user_balance' => '100', 'admin_id' => '1']);
        $u7->services()->attach($s10, ['by_cash' => true, 'bonus_point' => '80', 'user_balance' => '180', 'admin_id' => '1']);

        $u6->services()->attach($s12, ['by_cash' => false, 'bonus_point' => '0', 'user_balance' => '410', 'admin_id' => '1']);
        $u11->services()->attach($s12, ['by_cash' => false, 'bonus_point' => '0', 'user_balance' => '90', 'admin_id' => '1']);
        $u11->services()->attach($s13, ['by_cash' => true, 'bonus_point' => '60', 'user_balance' => '220', 'admin_id' => '1']);

    }
}

