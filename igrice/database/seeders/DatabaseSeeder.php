<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Game;
use \App\Models\User;
use \App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Category::truncate();
        User::truncate();
        Game::truncate();

        // User::factory(5)->create();
        Game::factory(5)->create();
        // Game::factory(15)->create();

        $this->call([
            // CategorySeeder::class,
            // GameSeeder::class
        ]);
        
    }
}
