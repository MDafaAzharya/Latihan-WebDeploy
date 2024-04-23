<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TingkatSKK;

class TingkatSKKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["nama_tingkat" => "Purwa"],
            ["nama_tingkat" => "Madya"],
            ["nama_tingkat" => "Utama"],
          ];
  
          TingkatSKK::insert($data);
    }
}
