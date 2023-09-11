<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Comments;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 5; $i++) {
            DB::table('comments')->insert([
                'rate' => $faker->numberBetween(1, 10),
                'user_id' => $faker->numberBetween(1, 3),
                'book_id' => $faker->numberBetween(1, 5),
                'comment' => $faker->paragraph()
            ]);
        }
    }
}
