<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle' => $this->faker->randomElement(['Admin', 'Manager', 'Coach', 'CME', 'Apprenant']),
        ];
    }

    public function Admin(){
        return $this->state(fn (array $attributes) =>[
           'libelle' => 'Admin',
        ]);
    }

    public function Manager(){
        return $this->state(fn (array $attributes) =>[
            'libelle' => 'Manager',
        ]);
    }

    public function Coach(){
        return $this->state(fn (array $attributes) =>[
            'libelle' => 'Coach',
        ]);
    }

    public function CME(){
        return $this->state(fn (array $attributes) =>[
            'libelle' => 'CME',
        ]);
    }

    public function Apprenant(){
        return $this->state(fn (array $attributes) =>[
            'libelle' => 'Apprenant',
        ]);
    }
    
}
