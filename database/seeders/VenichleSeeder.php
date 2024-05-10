<?php

namespace Database\Seeders;

use App\Models\Venichle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenichleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Venichle::factory()->count(50)->create();
    }
}
