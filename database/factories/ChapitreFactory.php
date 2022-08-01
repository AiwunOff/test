<?php

namespace Database\Factories;

use App\Models\chapitre;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChapitreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = chapitre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre' => $this->faker->sentence(3, true),
            'fichier_video' => $this->faker->sentence(3, true),
            'description' => $this->faker->sentence(6, true),
            'ordre' => $this->faker->unique(true)->numberBetween($min = 1, $max = 150),
            'module_id' => $this->faker->numberBetween(1, 11),
        ];
    }
}
