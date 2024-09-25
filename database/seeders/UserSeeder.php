<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::factory()->Admin()->create();
        User::factory()->Manager()->create();
        User::factory()->Coach()->create();
        User::factory()->CME()->create();
        User::factory()->Apprenant()->count(10)->create();
    }
}
