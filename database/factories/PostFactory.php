<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\Author;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'author_id' => Author::inRandomOrder()->first()->id, // Ensure authors exist first
            'image' => $this->faker->image('public/images/posts/images', 640, 480, null, false), // Save image to public/storage/images
            'createdAt' => $this->faker->dateTime,
        ];
    }
}
