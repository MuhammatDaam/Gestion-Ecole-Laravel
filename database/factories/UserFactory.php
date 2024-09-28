<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role = Role::inRandomOrder()->first();

        return [
            'prenom' => fake()->firstName(),
            'nom' => fake()->lastName(),
            'telephone' => fake()->phoneNumber(),
            'adresse' => fake()->address(),
            'photo' => fake()->imageUrl(),
            'role_id' => $role->id,
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
   public function Admin(){
       return $this->state(function (array $attributes) {
           return [
               'role_id' => Role::where('libelle', 'Admin')->first()->id,
           ];
       });
   }

   public function Manager(){
       return $this->state(function (array $attributes) {
           return [
               'role_id' => Role::where('libelle', 'Manager')->first()->id,
           ];
       });
   }

   public function Coach(){
       return $this->state(function (array $attributes) {
           return [
               'role_id' => Role::where('libelle', 'Coach')->first()->id,
           ];
       });
   }

   public function CME(){
       return $this->state(function (array $attributes) {
           return [
               'role_id' => Role::where('libelle', 'CME')->first()->id,
           ];
       });
   }

   public function Apprenant(){
       return $this->state(function (array $attributes) {
           return [
               'role_id' => Role::where('libelle', 'Apprenant')->first()->id,
           ];
       });
   }
}
