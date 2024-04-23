<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kepengurusan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call(UsersSeeder::class);
      $this->call(KategoriSeeder::class);
      $this->call(MabigusSeeder::class);
      $this->call(KepengurusanSeeder::class);
      $this->call(KontakSeeder::class);
      $this->call(ProkerSeeder::class);
      $this->call(SejarahSeeder::class);
      $this->call(TingkatSeeder::class);
      $this->call(VisimisiSeeder::class);
      $this->call(ProfileSeeder::class);
    }
}
