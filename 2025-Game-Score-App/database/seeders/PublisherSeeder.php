<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publisher::insert([ /*Sample data for the publisher index page.*/
            ['name'=>'Consumer Softproducts','logo'=>'Consumer_logo.jpg','bio'=>'An indescribable urge… A sudden flash of superior insight. Software, soft like clay, molded into ecstatic visions. Earth, selectively reuptake inhibited, wet with blood. A 21st century software promise of excellence. Preternatural Computing Destiny. Celestial Lifetectonic Events.'],
            ['name'=>'Gearbox Software','logo'=>'Gearbox_logo.png','bio'=>'Gearbox Software is an American video game development company based in Frisco, Texas. It was established as a limited liability company in February 1999 by five developers formerly of Rebel Boat Rocker.'],
            ['name'=>'Annapurna Interactive','logo'=>'Annapurna_logo.png','bio'=>'Annapurna Games (trade name: Annapurna Interactive) is an American video game publisher and developer. The company was founded in 2016 as a division of Annapurna Pictures. It focuses on publishing innovative and emotive indie games.'],
        ]);
    }
}
