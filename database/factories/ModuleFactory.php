<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Module::class;

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
            'description' => $this->faker->sentence(4, true),
            'ordre' => $i++,
            'formation_id' => '1',
        ];
    }
}
