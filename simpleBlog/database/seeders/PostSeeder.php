<?php

// database/seeders/PostSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get a random user to assign posts to
        $users = User::where('role', 'user')->get();

        // Create 5 posts (blogs)
        for ($i = 1; $i <= 5; $i++) {
            $post = Post::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'user_id' => $users->random()->id,
            ]);

            // Create up to 6 comments for each post
            for ($j = 1; $j <= 6; $j++) {
                $post->comments()->create([
                    'content' => $faker->sentence,
                    'user_id' => $users->random()->id,
                ]);
            }
        }
    }
}
