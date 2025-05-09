<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Post::create([
            'title' => 'Test Post',
            'description' => 'This is a test post content.',

        ]);
        Post::create([
            'title' => 'Test Post 2',
            'description' => 'This is a test post content.',

        ]);
        Post::create([
            'title' => 'Test Post 3',
            'description' => 'This is a test post content.',

        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.ee',
            'password' => Hash::make('test@test.ee'),
        ]);

        $this->call(ProductSeeder::class);
    }
}
