<?php

// database/seeders/CommentSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all posts (blogs)
        $posts = Post::all();

        // Loop through each post to create up to 7 comments
        foreach ($posts as $post) {
            // Generate up to 7 comments for each post
            $commentCount = rand(1, 7); // Random number between 1 and 7

            for ($i = 0; $i < $commentCount; $i++) {
                // Generate a random user for the comment
                $user = User::inRandomOrder()->first();

                // Create the comment
                Comment::create([
                    'content' => $faker->sentence,
                    'user_id' => $user->id, // Random user for the comment
                    'post_id' => $post->id, // The post this comment belongs to
                ]);
            }
        }
    }
}
