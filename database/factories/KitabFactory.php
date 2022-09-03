<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kitab>
 */
class KitabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(mt_rand(2,8)),
            'rumpun_id' => mt_rand(1,4),
            'slug' => fake()->slug(),
            'pengarang' => fake()->sentence(3)
        ];
    }
}
