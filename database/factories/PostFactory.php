<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

// php artisan make:factory PostFactory --model=Post
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            // Relate user_id with the User model id:
            'user_id' => 'App\Models\User'::factory(),
            'title' => $this->faker->sentence,
            'post_image' => $this->faker->imageUrl('900', '300'),
            'body' => $this->faker->paragraph,

        ];
    }
}
