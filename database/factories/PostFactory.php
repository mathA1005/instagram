<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition(): array
    {

        $Images = [
            //faut remettre des images dans "storage/app/public/placholders" à chaque fois
            'posts/laravel-7.jpg',
            'posts/laravel-8.jpg',
            'posts/laravel-11.jpg',
            'posts/laravel-12.jpg',
            'posts/laravel-14.jpg',
            'posts/laravel-15.jpg',
            'posts/laravel-16.jpg',
            'posts/laravel-17.jpg',
            'posts/laravel-18.jpg',

        ];

        return [
            'user_id' => User::get()->random()->id,
            'description' => $this->faker->realTextBetween($minNbChars = 1, $maxNbChars = 50),
            'image_url' => $this->faker->randomElement($Images), // pour placeholders internes
            'localisation' => $this->faker->city,
            'date' => $this->faker->dateTimeBetween('-1 month', '+ 1 month'),

        ];
    }
}
