<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'sexe' => $this->faker->randomElement($array = array ('masculin', 'féminin')) ,
            'admin' => $this->faker->unique(true)->numberBetween(0,1),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '1234aaaa',  
            'remember_token' => Str::random(50)
        ];
    }
}
