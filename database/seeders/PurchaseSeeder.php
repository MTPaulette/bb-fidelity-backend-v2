<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    //    \App\Models\User::factory(10)->create();
        /* service user */
        $u10 = \App\Models\User::find(10);
        $u2 = \App\Models\User::find(2);
        $u5 = \App\Models\User::find(5);
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

        $u10->services()->attach($s1, ['by_cash' => true, 'credit' => '1', 'debit' => '0', 'user_balance' => '400', 'admin_id' => '1']);
        $u5->services()->attach($s1, ['by_cash' => true, 'credit' => '1', 'debit' => '0', 'user_balance' => '70', 'admin_id' => '1']);
        $u10->services()->attach($s3, ['by_cash' => true, 'credit' => '1.5', 'debit' => '0', 'user_balance' => '130', 'admin_id' => '1']);
        $u2->services()->attach($s3, ['by_cash' => true, 'credit' => '1.5', 'debit' => '0', 'user_balance' => '130', 'admin_id' => '1']);
        $u2->services()->attach($s2, ['by_cash' => false, 'credit' => '0', 'debit' => '25', 'user_balance' => '800', 'admin_id' => '1']);

        $u2->services()->attach($s7, ['by_cash' => false, 'credit' => '0', 'debit' => '70', 'user_balance' => '350', 'admin_id' => '1']);
        $u7->services()->attach($s7, ['by_cash' => false, 'credit' => '0', 'debit' => '70', 'user_balance' => '350', 'admin_id' => '1']);
        $u7->services()->attach($s8, ['by_cash' => false, 'credit' => '0', 'debit' => '15', 'user_balance' => '30', 'admin_id' => '1']);
        $u7->services()->attach($s9, ['by_cash' => true, 'credit' => '4', 'debit' => '0', 'user_balance' => '100', 'admin_id' => '1']);
        $u7->services()->attach($s10, ['by_cash' => true, 'credit' => '8', 'debit' => '0', 'user_balance' => '180', 'admin_id' => '1']);

        $u6->services()->attach($s12, ['by_cash' => false, 'credit' => '0', 'debit' => '18', 'user_balance' => '410', 'admin_id' => '1']);
        $u11->services()->attach($s12, ['by_cash' => false, 'credit' => '0', 'debit' => '18', 'user_balance' => '90', 'admin_id' => '1']);
        $u11->services()->attach($s13, ['by_cash' => true, 'credit' => '5', 'debit' => '0', 'user_balance' => '220', 'admin_id' => '1']);

    }
}
