<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'home']);

        Permission::create(['name' => 'deceased']);
        Permission::create(['name' => 'relative']);
        Permission::create(['name' => 'cemetery']);

        Permission::create(['name' => 'niche']);
        Permission::create(['name' => 'mausoleum']);
        Permission::create(['name' => 'pavilion']);

        Permission::create(['name' => 'inhumation']);
        Permission::create(['name' => 'exhumation']); 
    }
}
