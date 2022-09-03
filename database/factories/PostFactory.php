<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
            'slug' => fake()->slug(),
            'excerpt' => fake()->paragraph(),
            'body' => '<p>' . implode('</p><p>', fake()->paragraphs(mt_rand(5,10))).'</p>',
            // 'published_at' => '',
            'category_id' => mt_rand(1,2),
            'user_id' => mt_rand(1,5)
        ];
    }
}
