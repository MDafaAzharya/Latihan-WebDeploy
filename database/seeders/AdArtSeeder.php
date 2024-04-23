<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adart;

class AdArtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tincidunt lobortis eleifend. Maecenas urna nisi, ultrices nec ullamcorper vel, congue in diam. 
            Nullam aliquet sit amet dui at tincidunt. 
            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum non facilisis tortor."
          ];
  
          Adart::insert($data);
    }
}
