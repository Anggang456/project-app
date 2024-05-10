<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $admin = User::create([
                'name' => 'Admin Role',
                'email' => 'admin@role.test',
                'password' => bcrypt('12345678')
            ]);
    
            $admin->assignrole('admin');
    
            $atasan = User::create([
                'name' => 'Atasan1 Role',
                'email' => 'atasan1@role.test',
                'password' => bcrypt('12345678')
            ]);
    
            $atasan->assignrole('atasan');

            $atasan = User::create([
                'name' => 'Atasan2 Role',
                'email' => 'atasan2@role.test',
                'password' => bcrypt('12345678')
            ]);
    
            $atasan->assignrole('atasan');
        }
    }
}
