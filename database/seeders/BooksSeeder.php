<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Books;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$faker = Faker::create();

        for($i = 0; $i < 5; $i++) {
            DB::table('books')->insert([
                'title' => $faker->unique()->word,
                'resume' => $faker->unique()->paragraph,
                'category_id' => $faker->numberBetween(1, 5),
                'author_id' => $faker->numberBetween(1, 5),
                'editor_id' => $faker->numberBetween(1, 5)
            ]);
        }*/

        \App\Models\Books::factory(5)->create();
    }
}
