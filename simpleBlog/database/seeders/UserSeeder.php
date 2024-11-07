<?php

// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Insert 1 admin
        $adminPassword = 'Admin@1234'; // You can adjust the password or generate dynamically if needed
        User::create([
            'name' => 'Admin ' . $faker->lastName,
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make($adminPassword),
            'role' => 'admin',
        ]);

        // Insert 3 regular users
        for ($i = 1; $i <= 3; $i++) {
            $userPassword = $faker->password(8, 20); // Generate random password matching the regex
            if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $userPassword)) {
                User::create([
                    'name' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make($userPassword),
                    'role' => 'user',
                ]);
            }
        }
    }
}
