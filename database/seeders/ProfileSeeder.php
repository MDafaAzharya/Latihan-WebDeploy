<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "title" => "Profil Pramuka",
            "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.
             In ac magna turpis. Aliquam volutpat sit amet neque nec laoreet. Donec rhoncus nisl id nulla laoreet, vitae mollis turpis volutpat. In a pharetra nisl. ",
          ];
  
          Profile::insert($data);
    }
}
