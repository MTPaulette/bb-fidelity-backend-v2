<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services=[
            //Etoa-Meki service
            ['name'=>"Open space EM (hour)", 'price'=>"1000", 'credit'=>"1", 'debit'=>"5", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Open space EM (hour)"],
            ['name'=>"Open space EM (day)", 'price'=>"5000", 'credit'=>"5", 'debit'=>"25", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Open space EM (day)"],

            ['name'=>"Bureaux privés standards EM (hour)", 'price'=>"2000", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Bureaux privés standards EM (hour)"],
            ['name'=>"Bureaux privés standards EM (day)", 'price'=>"10000", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Bureaux privés standards EM (day)"],
            
            ['name'=>"Meeting Corner EM (hour)", 'price'=>"5000", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Meeting Corner  EM (hour)"],
            ['name'=>"Meeting Corner EM (day)", 'price'=>"50000", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Meeting Corner  EM (day)"],
            ['name'=>"Meeting Corner EM (pack)", 'price'=>"23", 'credit'=>"0", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Meeting Corner  EM (day)"],
            
            ['name'=>"Grand Bureau Privé RC EM (hour)", 'price'=>"23", 'credit'=>"2", 'debit'=>"15", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Grand Bureau Privé RC EM (hour)"],
            ['name'=>"Grand Bureau Privé RC EM (midday)", 'price'=>"23", 'credit'=>"4", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Grand Bureau Privé RC EM (midday)"],
            ['name'=>"Grand Bureau Privé RC EM (day)", 'price'=>"23", 'credit'=>"8", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Grand Bureau Privé RC EM (day)"],
            
            ['name'=>"Maxi Bureau EM (hour)", 'price'=>"23", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Maxi Bureau EM (hour)"],
            ['name'=>"Maxi Bureau EM (midday)", 'price'=>"23", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Maxi Bureau EM (midday)"],
            ['name'=>"Maxi Bureau EM (day)", 'price'=>"23", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Maxi Bureau EM (day)"],

            //Elig edzoa service
            ['name'=>"Open space EE (hour)", 'price'=>"1000", 'credit'=>"1", 'debit'=>"5", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Open space EE (hour)"],
            ['name'=>"Open space EE (day)", 'price'=>"5000", 'credit'=>"5", 'debit'=>"25", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Open space EE (day)"],

            ['name'=>"Meeting Corner EE (hour)", 'price'=>"5000", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Meeting Corner  EE (hour)"],
            ['name'=>"Meeting Corner EE (day)", 'price'=>"50000", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Meeting Corner  EE (day)"],
            ['name'=>"Meeting Corner EE (pack)", 'price'=>"23", 'credit'=>"0", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Meeting Corner  EE (day)"],
            
            ['name'=>"Petits bureaux (Kitch + Toil) EE (hour)", 'price'=>"23", 'credit'=>"1.5", 'debit'=>"8", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Petits bureaux (Kitch + Toil) EE (hour)"],
            ['name'=>"Petits bureaux (Kitch + Toil) EE (day)", 'price'=>"23", 'credit'=>"7", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Petits bureaux (Kitch + Toil) EE (day)"],
            
            ['name'=>"Bureaux privés terrasse EE (hour)", 'price'=>"23", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Bureaux privés terrasse EE (hour)"],
            ['name'=>"Bureaux privés terrasse EE (day)", 'price'=>"23", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Bureaux privés terrasse EE (day)"],
            
            ['name'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (hour)", 'price'=>"23", 'credit'=>"2", 'debit'=>"15", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (hour)"],
            ['name'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (midday)", 'price'=>"23", 'credit'=>"4", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (midday)"],
            ['name'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (day)", 'price'=>"23", 'credit'=>"8", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (day)"],
            
            ['name'=>"Bureaux privés Premium EE (hour)", 'price'=>"23", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Bureaux privés Premium EE (hour)"],
            ['name'=>"Bureaux privés Premium EE (midday)", 'price'=>"23", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Bureaux privés Premium EE (midday)"],
            ['name'=>"Bureaux privés Premium EE (day)", 'price'=>"23", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Bureaux privés Premium EE (day)"],
            
            ['name'=>"Mini salle Reunion EE (hour)", 'price'=>"23", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Mini salle Reunion EE (hour)"],
            ['name'=>"Mini salle Reunion EE (midday)", 'price'=>"23", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Mini salle Reunion EE (midday)"],
            ['name'=>"Mini salle Reunion EE (day)", 'price'=>"23", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Mini salle Reunion EE (day)"],
            
            ['name'=>"Maxi Bureau EE (hour)", 'price'=>"23", 'credit'=>"3", 'debit'=>"20", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Maxi Bureau EE (hour)"],
            ['name'=>"Maxi Bureau EE (midday)", 'price'=>"23", 'credit'=>"6", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Maxi Bureau EE (midday)"],
            ['name'=>"Maxi Bureau EE (day)", 'price'=>"23", 'credit'=>"12", 'debit'=>"75", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Maxi Bureau EE (day)"],
            
            ['name'=>"Salle conference EE (hour)", 'price'=>"15000", 'credit'=>"4", 'debit'=>"30", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Salle conference EE (hour)"],
            ['name'=>"Salle conference EE (midday)", 'price'=>"50000", 'credit'=>"7", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Salle conference EE (midday)"],
            ['name'=>"Salle conference EE (day)", 'price'=>"23", 'credit'=>"15", 'debit'=>"100", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Salle conference EE (day)"],
           
            // services_Equipment
            ['name'=>"Ordinateur / Ecran / Gros VP (hour)", 'price'=>"23", 'credit'=>"0", 'debit'=>"5", 'service_type'=>'equipment', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Ordinateur / Ecran / Gros VP (hour)"],
            ['name'=>"Ordinateur / Ecran / Gros VP (day)", 'price'=>"23", 'credit'=>"0", 'debit'=>"25", 'service_type'=>'equipment', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Ordinateur / Ecran / Gros VP (day)"],

            ['name'=>"Kit visio / Mini VP (hour)", 'price'=>"23", 'credit'=>"0", 'debit'=>"10", 'service_type'=>'equipment', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Kit visio / Mini VP (hour)"],
            ['name'=>"Kit visio / Mini VP (day)", 'price'=>"23", 'credit'=>"0", 'debit'=>"50", 'service_type'=>'equipment', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Kit visio / Mini VP (day)"],
    
            ['name'=>"Casque (hour)", 'price'=>"23", 'credit'=>"0", 'debit'=>"5", 'service_type'=>'equipment', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Casque (hour)"],
            ['name'=>"Casque (day)", 'price'=>"23", 'credit'=>"0", 'debit'=>"10", 'service_type'=>'equipment', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Casque (day)"],
        ];

        foreach($services as $service) {
            \App\Models\Service::create($service);
        }

    }
}
