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
            ['name'=>"Meeting Corner EM (week)", 'price'=>"0", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Meeting Corner  EM (week)"],
            
            ['name'=>"Grand Bureau Privé RC EM (hour)", 'price'=>"0", 'credit'=>"2", 'debit'=>"15", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Grand Bureau Privé RC EM (hour)"],
            ['name'=>"Grand Bureau Privé RC EM (midday)", 'price'=>"0", 'credit'=>"4", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Grand Bureau Privé RC EM (midday)"],
            ['name'=>"Grand Bureau Privé RC EM (day)", 'price'=>"0", 'credit'=>"8", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Grand Bureau Privé RC EM (day)"],
            
            ['name'=>"Maxi Bureau EM (hour)", 'price'=>"0", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Maxi Bureau EM (hour)"],
            ['name'=>"Maxi Bureau EM (midday)", 'price'=>"0", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Maxi Bureau EM (midday)"],
            ['name'=>"Maxi Bureau EM (day)", 'price'=>"0", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Maxi Bureau EM (day)"],

            //Elig edzoa service
            ['name'=>"Open space EE (hour)", 'price'=>"1000", 'credit'=>"1", 'debit'=>"5", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Open space EE (hour)"],
            ['name'=>"Open space EE (day)", 'price'=>"5000", 'credit'=>"5", 'debit'=>"25", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Open space EE (day)"],

            ['name'=>"Meeting Corner EE (hour)", 'price'=>"5000", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Meeting Corner  EE (hour)"],
            ['name'=>"Meeting Corner EE (day)", 'price'=>"50000", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Meeting Corner  EE (day)"],
            ['name'=>"Meeting Corner EE (week)", 'price'=>"0", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Meeting Corner  EE (week)"],
            ['name'=>"Meeting Corner EE (pack)", 'price'=>"20000", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'pack', 'agency'=>'Elig Essono' ,'description'=>"Meeting Corner  EE (pack)"],
            
            ['name'=>"Petits bureaux (Kitch + Toil) EE (hour)", 'price'=>"0", 'credit'=>"1.5", 'debit'=>"8", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Petits bureaux (Kitch + Toil) EE (hour)"],
            ['name'=>"Petits bureaux (Kitch + Toil) EE (day)", 'price'=>"0", 'credit'=>"7", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Petits bureaux (Kitch + Toil) EE (day)"],
            
            ['name'=>"Bureaux privés terrasse EE (hour)", 'price'=>"0", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Bureaux privés terrasse EE (hour)"],
            ['name'=>"Bureaux privés terrasse EE (day)", 'price'=>"0", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Bureaux privés terrasse EE (day)"],
            
            ['name'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (hour)", 'price'=>"0", 'credit'=>"2", 'debit'=>"15", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (hour)"],
            ['name'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (midday)", 'price'=>"0", 'credit'=>"4", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (midday)"],
            ['name'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (day)", 'price'=>"0", 'credit'=>"8", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Bureau Privé standards (Iota + STD + LAMEC) EE (day)"],
            
            ['name'=>"Bureaux privés Premium EE (hour)", 'price'=>"0", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Bureaux privés Premium EE (hour)"],
            ['name'=>"Bureaux privés Premium EE (midday)", 'price'=>"0", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Bureaux privés Premium EE (midday)"],
            ['name'=>"Bureaux privés Premium EE (day)", 'price'=>"0", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Bureaux privés Premium EE (day)"],
            
            ['name'=>"Mini salle Reunion EE (hour)", 'price'=>"0", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Mini salle Reunion EE (hour)"],
            ['name'=>"Mini salle Reunion EE (midday)", 'price'=>"0", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Mini salle Reunion EE (midday)"],
            ['name'=>"Mini salle Reunion EE (day)", 'price'=>"0", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Mini salle Reunion EE (day)"],
            
            ['name'=>"Maxi Bureau EE (hour)", 'price'=>"0", 'credit'=>"3", 'debit'=>"20", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Maxi Bureau EE (hour)"],
            ['name'=>"Maxi Bureau EE (midday)", 'price'=>"0", 'credit'=>"6", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Maxi Bureau EE (midday)"],
            ['name'=>"Maxi Bureau EE (day)", 'price'=>"0", 'credit'=>"12", 'debit'=>"75", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Maxi Bureau EE (day)"],
            
            ['name'=>"Salle conference EE (hour)", 'price'=>"15000", 'credit'=>"4", 'debit'=>"30", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Salle conference EE (hour)"],
            ['name'=>"Salle conference EE (midday)", 'price'=>"50000", 'credit'=>"7", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Salle conference EE (midday)"],
            ['name'=>"Salle conference EE (day)", 'price'=>"0", 'credit'=>"15", 'debit'=>"100", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Salle conference EE (day)"],
           
            // services_Equipment
            ['name'=>"Ordinateur / Ecran / Gros VP (hour)", 'price'=>"1000", 'credit'=>"0", 'debit'=>"5", 'service_type'=>'equipment', 'validity'=>'01 hour' ,'description'=>"Ordinateur / Ecran / Gros VP (hour)"],
            ['name'=>"Ordinateur / Ecran / Gros VP (day)", 'price'=>"5000", 'credit'=>"0", 'debit'=>"25", 'service_type'=>'equipment', 'validity'=>'01 day', 'description'=>"Ordinateur / Ecran / Gros VP (day)"],

            ['name'=>"Kit visio / Mini VP (hour)", 'price'=>"2000", 'credit'=>"0", 'debit'=>"10", 'service_type'=>'equipment', 'validity'=>'01 hour', 'description'=>"Kit visio / Mini VP (hour)"],
            ['name'=>"Kit visio / Mini VP (day)", 'price'=>"10000", 'credit'=>"0", 'debit'=>"50", 'service_type'=>'equipment', 'validity'=>'01 day', 'description'=>"Kit visio / Mini VP (day)"],
    
            ['name'=>"Casque (hour)", 'price'=>"1000", 'credit'=>"0", 'debit'=>"5", 'service_type'=>'equipment', 'validity'=>'01 hour', 'description'=>"Casque (hour)"],
            ['name'=>"Casque (day)", 'price'=>"5000", 'credit'=>"0", 'debit'=>"25", 'service_type'=>'equipment', 'validity'=>'01 day', 'description'=>"Casque (day)"],

            ['name'=>"video projecteur (hour)", 'price'=>"1000", 'credit'=>"0", 'debit'=>"5", 'service_type'=>'equipment', 'validity'=>'01 hour', 'description'=>"video projecteur (hour)"],
            ['name'=>"video projecteur (day)", 'price'=>"5000", 'credit'=>"0", 'debit'=>"25", 'service_type'=>'equipment', 'validity'=>'01 day', 'description'=>"video projecteur (day)"],

            //Etoa-Meki new service
            ['name'=>"Open space EM (week)", 'price'=>"0", 'credit'=>"25", 'debit'=>"125", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Etoa-Meki' ,'description'=>"Open space EM (week)"],

            ['name'=>"Progress (hour)", 'price'=>"2500", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Progress (hour)"],
            ['name'=>"Progress (day)", 'price'=>"12000", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Progress (day)"],
            ['name'=>"Progress (week)", 'price'=>"50000", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Etoa-Meki' ,'description'=>"Progress (week)"],
            ['name'=>"Progress (month)", 'price'=>"120000", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Etoa-Meki' ,'description'=>"Progress (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Eureka Inspirational (hour)", 'price'=>"2500", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Eureka Inspirational (hour)"],
            ['name'=>"Eureka Inspirational (day)", 'price'=>"12000", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Eureka Inspirational (day)"],
            ['name'=>"Eureka Inspirational (week)", 'price'=>"50000", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Etoa-Meki' ,'description'=>"Eureka Inspirational (week)"],
            ['name'=>"Eureka Inspirational (month)", 'price'=>"120000", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Etoa-Meki' ,'description'=>"Eureka Inspirational (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"The Good Deal (hour)", 'price'=>"0", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"The Good Deal (hour)"],
            ['name'=>"The Good Deal (day)", 'price'=>"0", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"The Good Deal (day)"],
            ['name'=>"The Good Deal (week)", 'price'=>"0", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Etoa-Meki' ,'description'=>"The Good Deal (week)"],
            
            ['name'=>"Game Changer Room (hour)", 'price'=>"0", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Game Changer Room (hour)"],
            ['name'=>"Game Changer Room (day)", 'price'=>"0", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Game Changer Room (day)"],
            ['name'=>"Game Changer Room (week)", 'price'=>"0", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Etoa-Meki' ,'description'=>"Game Changer Room (week)"],
            
            ['name'=>"Disruptive Lab (hour)", 'price'=>"2000", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Disruptive Lab (hour)"],
            ['name'=>"Disruptive Lab (day)", 'price'=>"10000", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Disruptive Lab (day)"],
            ['name'=>"Disruptive Lab (week)", 'price'=>"40000", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Etoa-Meki' ,'description'=>"Disruptive Lab (week)"],
            ['name'=>"Disruptive Lab (month)", 'price'=>"100000", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Etoa-Meki' ,'description'=>"Disruptive Lab (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Bold (hour)", 'price'=>"2500", 'credit'=>"2", 'debit'=>"15", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Bold (hour)"],
            ['name'=>"Bold (midday)", 'price'=>"7500", 'credit'=>"4", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Etoa-Meki' ,'description'=>"Bold (midday)"],
            ['name'=>"Bold (day)", 'price'=>"0", 'credit'=>"8", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Bold (day)"],
            ['name'=>"Bold (week)", 'price'=>"0", 'credit'=>"40", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Etoa-Meki' ,'description'=>"Bold (week)"],
            
            ['name'=>"Master Mind (hour)", 'price'=>"5000", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Etoa-Meki' ,'description'=>"Master Mind (hour)"],
            ['name'=>"Master Mind (midday)", 'price'=>"15000", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Etoa-Meki' ,'description'=>"Master Mind (midday)"],
            ['name'=>"Master Mind (day)", 'price'=>"25000", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Etoa-Meki' ,'description'=>"Master Mind (day)"],
            ['name'=>"Master Mind (week)", 'price'=>"75000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Etoa-Meki' ,'description'=>"Master Mind (week)"],
            ['name'=>"Master Mind (month)", 'price'=>"220000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Etoa-Meki' ,'description'=>"Master Mind (month)", 'user_type'=>'subscriber'],
            
            
            //Elig essono service
            ['name'=>"Open space EE (week)", 'price'=>"0", 'credit'=>"25", 'debit'=>"125", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Elig Essono' ,'description'=>"Open space EE (week)"],
            
            ['name'=>"Creator's 1 (hour)", 'price'=>"2500", 'credit'=>"1.5", 'debit'=>"8", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Creator's 1 (hour)"],
            ['name'=>"Creator's 1 (day)", 'price'=>"12000", 'credit'=>"7", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Creator's 1 (day)"],
            ['name'=>"Creator's 1 (month)", 'price'=>"100000", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Creator's 1 (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Creator's 2 (hour)", 'price'=>"2000", 'credit'=>"1.5", 'debit'=>"8", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Creator's 2 (hour)"],
            ['name'=>"Creator's 2 (day)", 'price'=>"10000", 'credit'=>"7", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Creator's 2 (day)"],
            ['name'=>"Creator's 2 (month)", 'price'=>"80000", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Creator's 2 (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Conquerors (hour)", 'price'=>"2500", 'credit'=>"1.5", 'debit'=>"10", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Conquerors (hour)"],
            ['name'=>"Conquerors (day)", 'price'=>"12000", 'credit'=>"7", 'debit'=>"50", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Conquerors (day)"],
            ['name'=>"Conquerors (month)", 'price'=>"120000", 'credit'=>"35", 'debit'=>"70", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Conquerors (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Phoenix Suit (hour)", 'price'=>"3000", 'credit'=>"2", 'debit'=>"15", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Phoenix Suit (hour)"],
            ['name'=>"Phoenix Suit (midday)", 'price'=>"10000", 'credit'=>"4", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Elig Essono' ,'description'=>"Phoenix Suit (midday)"],
            ['name'=>"Phoenix Suit (day)", 'price'=>"150000", 'credit'=>"8", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Phoenix Suit (day)"],
            ['name'=>"Phoenix Suit (week)", 'price'=>"75000", 'credit'=>"40", 'debit'=>"300", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Elig Essono' ,'description'=>"Phoenix Suit (week)"],
            ['name'=>"Phoenix Suit (month)", 'price'=>"190000", 'credit'=>"40", 'debit'=>"300", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Phoenix Suit (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Challenger's space (hour)", 'price'=>"1500", 'credit'=>"2", 'debit'=>"15", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Challenger's space (hour)"],
            ['name'=>"Challenger's space (midday)", 'price'=>"0", 'credit'=>"4", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Elig Essono' ,'description'=>"Challenger's space (midday)"],
            ['name'=>"Challenger's space (day)", 'price'=>"5000", 'credit'=>"8", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Challenger's space (day)"],
            ['name'=>"Challenger's space (week)", 'price'=>"20000", 'credit'=>"40", 'debit'=>"300", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Elig Essono' ,'description'=>"Challenger's space (week)"],
            ['name'=>"Challenger's space (month)", 'price'=>"50000", 'credit'=>"40", 'debit'=>"300", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Challenger's space (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Impact (hour)", 'price'=>"3500", 'credit'=>"2", 'debit'=>"15", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Impact (hour)"],
            ['name'=>"Impact (midday)", 'price'=>"12000", 'credit'=>"4", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Elig Essono' ,'description'=>"Impact (midday)"],
            ['name'=>"Impact (day)", 'price'=>"20000", 'credit'=>"8", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Impact (day)"],
            ['name'=>"Impact (week)", 'price'=>"75000", 'credit'=>"40", 'debit'=>"300", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Elig Essono' ,'description'=>"Impact (week)"],
            ['name'=>"Impact (month)", 'price'=>"24000", 'credit'=>"40", 'debit'=>"300", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Impact (month)"],
            
            ['name'=>"Leader Suite (hour)", 'price'=>"7000", 'credit'=>"2", 'debit'=>"15", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Leader Suite (hour)", 'user_type'=>'subscriber'],
            ['name'=>"Leader Suite (midday)", 'price'=>"20000", 'credit'=>"4", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Elig Essono' ,'description'=>"Leader Suite (midday)", 'user_type'=>'subscriber'],
            ['name'=>"Leader Suite (day)", 'price'=>"27000", 'credit'=>"8", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Leader Suite (day)", 'user_type'=>'subscriber'],
            ['name'=>"Leader Suite (week)", 'price'=>"100000", 'credit'=>"40", 'debit'=>"300", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Elig Essono' ,'description'=>"Leader Suite (week)", 'user_type'=>'subscriber'],
            ['name'=>"Leader Suite (month)", 'price'=>"370000", 'credit'=>"40", 'debit'=>"300", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Leader Suite (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Leader Suite Petite salle (hour)", 'price'=>"5000", 'credit'=>"2", 'debit'=>"15", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Leader Suite Petite salle (hour)", 'user_type'=>'subscriber'],
            ['name'=>"Leader Suite Petite salle (midday)", 'price'=>"15000", 'credit'=>"4", 'debit'=>"40", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Elig Essono' ,'description'=>"Leader Suite Petite salle (midday)", 'user_type'=>'subscriber'],
            ['name'=>"Leader Suite Petite salle (day)", 'price'=>"25000", 'credit'=>"8", 'debit'=>"60", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Leader Suite Petite salle (day)", 'user_type'=>'subscriber'],
            
            ['name'=>"Butterfly 1 (hour)", 'price'=>"3500", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Butterfly 1 (hour)", 'user_type'=>'subscriber'],
            ['name'=>"Butterfly 1 (midday)", 'price'=>"12000", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Elig Essono' ,'description'=>"Butterfly 1 (midday)", 'user_type'=>'subscriber'],
            ['name'=>"Butterfly 1 (day)", 'price'=>"20000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Butterfly 1 (day)", 'user_type'=>'subscriber'],
            ['name'=>"Butterfly 1 (week)", 'price'=>"75000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Elig Essono' ,'description'=>"Butterfly 1 (week)", 'user_type'=>'subscriber'],
            ['name'=>"Butterfly 1 (month)", 'price'=>"240000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Butterfly 1 (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Butterfly 2 (hour)", 'price'=>"3500", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Butterfly 2 (hour)", 'user_type'=>'subscriber'],
            ['name'=>"Butterfly 2 (midday)", 'price'=>"12000", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Elig Essono' ,'description'=>"Butterfly 2 (midday)", 'user_type'=>'subscriber'],
            ['name'=>"Butterfly 2 (day)", 'price'=>"20000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Butterfly 2 (day)", 'user_type'=>'subscriber'],
            ['name'=>"Butterfly 2 (week)", 'price'=>"75000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Elig Essono' ,'description'=>"Butterfly 2 (week)", 'user_type'=>'subscriber'],
            ['name'=>"Butterfly 2 (month)", 'price'=>"240000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Butterfly 2 (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Eagles 1 (hour)", 'price'=>"3500", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Eagles 1 (hour)", 'user_type'=>'subscriber'],
            ['name'=>"Eagles 1 (midday)", 'price'=>"12000", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Elig Essono' ,'description'=>"Eagles 1 (midday)", 'user_type'=>'subscriber'],
            ['name'=>"Eagles 1 (day)", 'price'=>"20000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Eagles 1 (day)", 'user_type'=>'subscriber'],
            ['name'=>"Eagles 1 (week)", 'price'=>"75000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Elig Essono' ,'description'=>"Eagles 1 (week)", 'user_type'=>'subscriber'],
            ['name'=>"Eagles 1 (month)", 'price'=>"240000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Eagles 1 (month)", 'user_type'=>'subscriber'],
            
            ['name'=>"Eagles 2 (hour)", 'price'=>"3500", 'credit'=>"2.5", 'debit'=>"18", 'service_type'=>'space', 'validity'=>'01 hour', 'agency'=>'Elig Essono' ,'description'=>"Eagles 2 (hour)", 'user_type'=>'subscriber'],
            ['name'=>"Eagles 2 (midday)", 'price'=>"12000", 'credit'=>"5", 'debit'=>"45", 'service_type'=>'space', 'validity'=>'midday', 'agency'=>'Elig Essono' ,'description'=>"Eagles 2 (midday)", 'user_type'=>'subscriber'],
            ['name'=>"Eagles 2 (day)", 'price'=>"20000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 day', 'agency'=>'Elig Essono' ,'description'=>"Eagles 2 (day)", 'user_type'=>'subscriber'],
            ['name'=>"Eagles 2 (week)", 'price'=>"75000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 week', 'agency'=>'Elig Essono' ,'description'=>"Eagles 2 (week)", 'user_type'=>'subscriber'],
            ['name'=>"Eagles 2 (month)", 'price'=>"240000", 'credit'=>"10", 'debit'=>"65", 'service_type'=>'space', 'validity'=>'01 month', 'agency'=>'Elig Essono' ,'description'=>"Eagles 2 (month)", 'user_type'=>'subscriber'],
            
        ];

        foreach($services as $service) {
            \App\Models\Service::create($service);
        }

    }
}
