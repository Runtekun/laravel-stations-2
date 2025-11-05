<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Practice;
use App\Models\Movie;
use App\Models\Genre;
use Database\Seeders\SheetSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Genre::factory(10)->create();
        Practice::factory(10)->create();
        Movie::factory(10)->create();
        $this->call(SheetSeeder::class);
    }
}
