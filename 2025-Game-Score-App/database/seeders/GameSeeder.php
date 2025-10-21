<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
Use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();
        //
        Game::insert([   /*Hard coded games for index page.*/
            [
                'title'=> 'Cruelty Squad',
                'description'=> 'An immersive power fantasy simulator with tactical stealth elements set in a sewage infused garbage world',
                'genre'=> 'action',
                'year'=> 2021,
                'image'=> 'CrueltySquad.jpg',
                'created_at'=> $currentTimestamp,
                'updated_at'=> $currentTimestamp
            ],
            [
                'title'=> 'Risk of Rain 2',
                'description'=> 'Escape a chaotic alien planet by fighting through hordes of frenzied monsters – with your friends, or on your own. Combine loot in surprising ways and master each character until you become the havoc you feared upon your first crash landing.',
                'genre'=> 'action',
                'year'=> 2020,
                'image'=> 'RiskofRain2.jpg',
                'created_at'=> $currentTimestamp,
                'updated_at'=> $currentTimestamp
            ],
            [
                'title'=> 'Outer Wilds',
                'description'=> 'Outer Wilds is a critically-acclaimed and award-winning open world mystery about a solar system trapped in an endless time loop.',
                'genre'=> 'adventure',
                'year'=> 2020,
                'image'=> 'OuterWilds.jpg',
                'created_at'=> $currentTimestamp,
                'updated_at'=> $currentTimestamp
            ],
        ]);
    }
}
