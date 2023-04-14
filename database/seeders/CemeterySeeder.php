<?php

namespace Database\Seeders;

use App\Models\Cemetery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CemeterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cemetery::create(['appellation' => 'Yanamayo']);
        Cemetery::create(['appellation' => 'Laykakota']);
    }
}
