<?php

namespace Database\Factories;

use App\Models\formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = formation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $i = 1;
        return [
            'titre' => $this->faker->sentence(3, true),
            'description' => $this->faker->sentence(6, true),
            'ordre' => $i++,
        ];
    }
}
