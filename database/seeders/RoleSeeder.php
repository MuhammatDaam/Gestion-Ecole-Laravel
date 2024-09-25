<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create(['libelle' => 'Admin']);
        Role::factory()->create(['libelle' => 'Manager']);
        Role::factory()->create(['libelle' => 'Coach']);
        Role::factory()->create(['libelle' => 'CME']);
        Role::factory()->create(['libelle' => 'Apprenant']);
    }
}
