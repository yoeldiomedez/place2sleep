<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Deceased::factory()->count(100)->create(); 
        \App\Models\Relative::factory()->count(100)->create(); 

        $this->call(CemeterySeeder::class);
        
        \App\Models\Pavilion::factory()->count(100)->create(); 

        $this->call(NicheSeeder::class);
        $this->call(MausoleumSeeder::class);

        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
    }
}
