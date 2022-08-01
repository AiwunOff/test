<?php

namespace Database\Factories;

use App\Models\faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = faq::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->sentence(5, true),
            'reponse' => $this->faker->sentence(18, true),
            'formation_id' => 1,
        ];
    }
}
