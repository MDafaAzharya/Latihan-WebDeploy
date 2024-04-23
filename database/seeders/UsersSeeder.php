<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $user = User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            // 'username' => 'admin',
            'nomor' => '0895703157598',
            'angkatan' => '33',
            'role' => 'admin',
            'password' => Hash::make('admin'),
        ]);
    }
}
