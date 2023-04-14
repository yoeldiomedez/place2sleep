<?php

namespace Database\Seeders;

use App\Models\Pavilion;
use App\Models\Mausoleum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MausoleumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pavilions = Pavilion::select('id')
                            ->where('type', 'M')
                            ->whereIn('cemetery_id', [1, 2])
                            ->count();

        Mausoleum::factory()->count($pavilions)->create(); 
    }
}
