<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Mandatory
        $this->call(PermissionSeeder::class,);
        
        // Demo
        $this->call(DemoSeeder::class);
    }
}
