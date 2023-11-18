<?php

namespace Database\Seeders;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Follower::truncate();

        // Générer des données de followers aléatoires
        $followersCount = 50; // Vous pouvez ajuster le nombre de followers souhaité

        for ($i = 0; $i < $followersCount; $i++) {
            $follower = User::all()->random();
            $followed = User::where('id', '!=', $follower->id)->get()->random();

            Follower::create([
                'follower_id' => $follower->id,
                'followed_id' => $followed->id,
            ]);
        }
    }}
