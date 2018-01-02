<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            \App\Movie::create([
                'title' => $faker->sentence(2),
                'writer' => $faker->name,
                'director' => $faker->name,
                'movie_length' => $faker->numberBetween(100, 200),
                'movie_year' => $faker->numberBetween(1956, 2017),
                'description' => $faker->paragraph(2),
                'imdb_url' => $faker->url,
                'imdb_rank' => $faker->numberBetween(1, 9)
            ]);
        }
    }
}
