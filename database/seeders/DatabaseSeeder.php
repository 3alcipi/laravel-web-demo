<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Type;
use App\Models\User;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
         $this->call([
            RolesSeeder::class,
        ]);
        
        User::factory()->create([
            'name' => 'Edwin Cigueñas',
            'email' => 'edwin.3acp@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('admin');

        User::factory(20)->create();
       

        Brand::factory(10)->create([
            'status' => 1,
        ]);
        Type::factory(10)->create([
            'status' => 1,
        ]);
        Vehicle::factory(10)->create();

    }
}
