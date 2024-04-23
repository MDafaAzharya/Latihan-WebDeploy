<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tingkat;


class TingkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["nama_tingkat" => "Bantara"],
            ["nama_tingkat" => "Laksana"],
            ["nama_tingkat" => "Garuda"],
            ["nama_tingkat" => "Pensiun"],
          ];
  
          Tingkat::insert($data);
    }
}
