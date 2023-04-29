<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Deceased;
use App\Models\Relative;
use App\Models\Cemetery;
use App\Models\Pavilion;
use App\Models\Niche;
use App\Models\Mausoleum;
use App\Models\Inhumation;
use App\Models\Exhumation;

use Spatie\Permission\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gets all permissions via Gate::before rule; see AuthServiceProvider
        $role = Role::create(['name' => 'Super Admin']);
        
        $user = User::factory()
        ->hasAttached(
            Cemetery::factory()->count(2)
        )
        ->create([
            'name'  => 'Yoel Diomedez',
            'email' => 'yoeldiomedez@gmail.com',
        ]);

        $user->assignRole($role);
        
        Deceased::factory()->count(50)->create(); 
        Relative::factory()->count(50)->create(); 

        $cemeteries = Cemetery::all();

        foreach ($cemeteries as $cemetery) {

            Pavilion::factory()
                    ->count(50)
                    ->for($cemetery)
                    ->sequence(
                        ['type' => 'N'],
                        ['type' => 'M'],
                    )
                    ->create();            
        }

        $pavilions = Pavilion::all();

        foreach ($pavilions as $pavilion) {

            switch ($pavilion->type) {
                case 'Nicho':
                    Niche::factory()->for($pavilion)->create();  
                    break;
                case 'Mausoleo':
                    Mausoleum::factory()->for($pavilion)->create(); 
                    break;
            }
        }

        $niches = Niche::inRandomOrder()->limit(15)->get();

        foreach ($niches as $niche) {

            Inhumation::factory()->for(
                $niche, 'buriable'
            )->create([
                'deceased_id' => Deceased::limit(25)->inRandomOrder()->first()->id,
                'relative_id' => Relative::limit(25)->inRandomOrder()->first()->id,
                'amount'      => $niche->price,
            ]);

            $niche->state = 'O';
            $niche->save();
        }

        $mausoleums = Mausoleum::inRandomOrder()->limit(15)->get();

        foreach ($mausoleums as $mausoleum) {

            Inhumation::factory()->for(
                $mausoleum, 'buriable'
            )->create([
                'deceased_id' => Deceased::offset(25)->inRandomOrder()->first()->id,
                'relative_id' => Relative::offset(25)->inRandomOrder()->first()->id,
                'amount'      => $mausoleum->price / $mausoleum->size,
            ]);

            $mausoleum->availability = $mausoleum->availability - 1;
            $mausoleum->save();
        }

        $inhumations = Inhumation::inRandomOrder()->limit(10)->get();

        foreach ($inhumations as $inhumation) {
            Exhumation::factory()->for($inhumation)->create();
        }
    }
}
