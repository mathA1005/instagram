<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowerFactory extends Factory
{
    /**
     * Le nom du modèle correspondant à la Factory.
     *
     * @var string
     */
    protected $model = Follower::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array
     */
    public function definition()
    {
        // Définir les attributs par défaut du modèle Follower
        return [
            'follower_id' => User::all()->random()->id,
            'following_id' => User::all()->random()->id,
        ];
    }
}
