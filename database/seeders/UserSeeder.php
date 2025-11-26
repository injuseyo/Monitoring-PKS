<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Angel',
                'email' => 'angel@example.com',
                'password' => Hash::make('12345'),  
                'role' => 'admin',
                'jabatan_id' => 1,
            ],
            [
                'name' => 'Veda',
                'email' => 'veda@example.com',
                'password' => Hash::make('12345'), 
                'role' => 'pegawai',
                'jabatan_id' => 2,
            ],
            [
                'name' => 'Hasna',
                'email' => 'hasna@example.com',
                'password' => Hash::make('12345'),
                'role' => 'pegawai',
                'jabatan_id' => 3,
            ],
        ]);
    }
}
