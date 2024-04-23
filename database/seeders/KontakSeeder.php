<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kontak;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "alamat" => "Katapang",
            "telepon" => "089",
            "email"=> "admin@gmail.com",
          ];
  
          Kontak::insert($data);
    }
}
