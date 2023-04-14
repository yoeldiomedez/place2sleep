<?php

namespace Database\Seeders;

use App\Models\Pavilion;
use App\Models\Niche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NicheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pavilions = Pavilion::select('id')
                            ->where('type', 'N')
                            ->whereIn('cemetery_id', [1, 2])
                            ->count();

        Niche::factory()->count($pavilions)->create(); 

    }
}
