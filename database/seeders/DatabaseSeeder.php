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


       /**
        * ==================== service ================
        */
        // \App\Models\Service::factory()->create([
        $services =[
            ['name'=>"Open space EE/EM (hour)", 'price'=>"1000", 'credit'=>"1", 'debit'=>"5", 'validity'=>'01 Hour', 'description'=>"Open space EE/EM (hour)"],
            ['name'=>"Open space EE/EM (day)", 'price'=>"5000", 'credit'=>"5", 'debit'=>"25", 'validity'=>'01 Day', 'description'=>"Open space EE/EM (day)"],

            ['name'=>"Bureaux privés standards EM (hour)", 'price'=>"2000", 'credit'=>"1.5", 'debit'=>"10", 'validity'=>'01 Hour', 'description'=>"Bureaux privés standards EM (hour)"],
            ['name'=>"Bureaux privés standards EM (day)", 'price'=>"10000", 'credit'=>"7", 'debit'=>"50", 'validity'=>'01 Day', 'description'=>"Bureaux privés standards EM (day)"],
            
            ['name'=>"Meeting Corner EE/EM (hour)", 'price'=>"5000", 'credit'=>"1.5", 'debit'=>"10", 'validity'=>'01 Hour', 'description'=>"Meeting Corner  EE/EM (hour)"],
            ['name'=>"Meeting Corner EE/EM (day)", 'price'=>"50000", 'credit'=>"7", 'debit'=>"50", 'validity'=>'01 Day', 'description'=>"Meeting Corner  EE/EM (day)"],
            ['name'=>"Meeting Corner EE/EM (pack)", 'price'=>"23", 'credit'=>"0", 'debit'=>"70", 'validity'=>'01 Day', 'description'=>"Meeting Corner  EE/EM (day)"],
            
            ['name'=>"Grand Bureau Privé RC EM (hour)", 'price'=>"23", 'credit'=>"2", 'debit'=>"15", 'validity'=>'01 Hour', 'description'=>"Grand Bureau Privé RC EM (hour)"],
            ['name'=>"Grand Bureau Privé RC EM (midday)", 'price'=>"23", 'credit'=>"4", 'debit'=>"40", 'validity'=>'01 Day', 'description'=>"Grand Bureau Privé RC EM (midday)"],
            ['name'=>"Grand Bureau Privé RC EM (day)", 'price'=>"23", 'credit'=>"8", 'debit'=>"60", 'validity'=>'01 Day', 'description'=>"Grand Bureau Privé RC EM (day)"],
            
            ['name'=>"Maxi Bureau EM (hour)", 'price'=>"23", 'credit'=>"2.5", 'debit'=>"18", 'validity'=>'01 Hour', 'description'=>"Maxi Bureau EM (hour)"],
            ['name'=>"Maxi Bureau EM (midday)", 'price'=>"23", 'credit'=>"5", 'debit'=>"45", 'validity'=>'01 Day', 'description'=>"Maxi Bureau EM (midday)"],
            ['name'=>"Maxi Bureau EM (day)", 'price'=>"23", 'credit'=>"10", 'debit'=>"65", 'validity'=>'01 Day', 'description'=>"Maxi Bureau EM (day)"],
            
            ['name'=>"Petits bureaux (Kitch + Toil) EE (hour)", 'price'=>"23", 'credit'=>"1.5", 'debit'=>"8", 'validity'=>'01 Hour', 'description'=>"Petits bureaux (Kitch + Toil) EE (hour)"],
            ['name'=>"Petits bureaux (Kitch + Toil) EE (day)", 'price'=>"23", 'credit'=>"7", 'debit'=>"40", 'validity'=>'01 Day', 'description'=>"Petits bureaux (Kitch + Toil) EE (day)"],
            
            ['name'=>"Bureaux privés terrasse EE (hour)", 'price'=>"23", 'credit'=>"1.5", 'debit'=>"10", 'validity'=>'01 Hour', 'description'=>"Bureaux privés terrasse EE (hour)"],
            ['name'=>"Bureaux privés terrasse EE (day)", 'price'=>"23", 'credit'=>"7", 'debit'=>"50", 'validity'=>'01 Day', 'description'=>"Bureaux privés terrasse EE (day)"],
            
            ['name'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (hour)", 'price'=>"23", 'credit'=>"2", 'debit'=>"15", 'validity'=>'01 Hour', 'description'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (hour)"],
            ['name'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (midday)", 'price'=>"23", 'credit'=>"4", 'debit'=>"40", 'validity'=>'01 Day', 'description'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (midday)"],
            ['name'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (day)", 'price'=>"23", 'credit'=>"8", 'debit'=>"60", 'validity'=>'01 Day', 'description'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (day)"],
            
            ['name'=>"Bureaux privés Premium EE (hour)", 'price'=>"23", 'credit'=>"2.5", 'debit'=>"18", 'validity'=>'01 Hour', 'description'=>"Bureaux privés Premium EE (hour)"],
            ['name'=>"Bureaux privés Premium EE (midday)", 'price'=>"23", 'credit'=>"5", 'debit'=>"45", 'validity'=>'01 Day', 'description'=>"Bureaux privés Premium EE (midday)"],
            ['name'=>"Bureaux privés Premium EE (day)", 'price'=>"23", 'credit'=>"10", 'debit'=>"65", 'validity'=>'01 Day', 'description'=>"Bureaux privés Premium EE (day)"],
            
            ['name'=>"Mini salle Reunion EE (hour)", 'price'=>"23", 'credit'=>"2.5", 'debit'=>"18", 'validity'=>'01 Hour', 'description'=>"Mini salle Reunion EE (hour)"],
            ['name'=>"Mini salle Reunion EE (midday)", 'price'=>"23", 'credit'=>"5", 'debit'=>"45", 'validity'=>'01 Day', 'description'=>"Mini salle Reunion EE (midday)"],
            ['name'=>"Mini salle Reunion EE (day)", 'price'=>"23", 'credit'=>"10", 'debit'=>"65", 'validity'=>'01 Day', 'description'=>"Mini salle Reunion EE (day)"],
            
            ['name'=>"Maxi Bureau EE (hour)", 'price'=>"23", 'credit'=>"3", 'debit'=>"20", 'validity'=>'01 Hour', 'description'=>"Maxi Bureau EE (hour)"],
            ['name'=>"Maxi Bureau EE (midday)", 'price'=>"23", 'credit'=>"6", 'debit'=>"50", 'validity'=>'01 Day', 'description'=>"Maxi Bureau EE (midday)"],
            ['name'=>"Maxi Bureau EE (day)", 'price'=>"23", 'credit'=>"12", 'debit'=>"75", 'validity'=>'01 Day', 'description'=>"Maxi Bureau EE (day)"],
            
            ['name'=>"Salle conference EE (hour)", 'price'=>"15000", 'credit'=>"4", 'debit'=>"30", 'validity'=>'01 Hour', 'description'=>"Salle conference EE (hour)"],
            ['name'=>"Salle conference EE (midday)", 'price'=>"50000", 'credit'=>"7", 'debit'=>"60", 'validity'=>'01 Day', 'description'=>"Salle conference EE (midday)"],
            ['name'=>"Salle conference EE (day)", 'price'=>"23", 'credit'=>"15", 'debit'=>"100", 'validity'=>'01 Day', 'description'=>"Salle conference EE (day)"],
            

            ['name'=>"Ordinateur / Ecran / Gros VP (hour)", 'price'=>"23", 'credit'=>"0", 'debit'=>"5", 'validity'=>'01 Hour', 'description'=>"Ordinateur / Ecran / Gros VP (hour)"],
            ['name'=>"Ordinateur / Ecran / Gros VP (day)", 'price'=>"23", 'credit'=>"0", 'debit'=>"25", 'validity'=>'01 Day', 'description'=>"Ordinateur / Ecran / Gros VP (day)"],

            ['name'=>"Kit visio / Mini VP (hour)", 'price'=>"23", 'credit'=>"0", 'debit'=>"10", 'validity'=>'01 Hour', 'description'=>"Kit visio / Mini VP (hour)"],
            ['name'=>"Kit visio / Mini VP (day)", 'price'=>"23", 'credit'=>"0", 'debit'=>"50", 'validity'=>'01 Day', 'description'=>"Kit visio / Mini VP (day)"],
    
            ['name'=>"Casque (hour)", 'price'=>"23", 'credit'=>"0", 'debit'=>"5", 'validity'=>'01 Hour', 'description'=>"Casque (hour)"],
            ['name'=>"Casque (day)", 'price'=>"23", 'credit'=>"0", 'debit'=>"10", 'validity'=>'01 Day', 'description'=>"Casque (day)"],
            
        ];

        \App\Models\Service::insert($services);


       /**
        * ==================== service ================
        */
        
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

        $u10->services()->attach($s1, ['by_cash' => true, 'credit' => '1', 'debit' => '0', 'user_balance' => '400', 'admin_id' => '1']);
        $u3->services()->attach($s1, ['by_cash' => true, 'credit' => '1', 'debit' => '0', 'user_balance' => '70', 'admin_id' => '1']);
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

