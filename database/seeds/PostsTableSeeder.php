<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Post');
        $faker->addProvider(new BlogArticleFaker\FakerProvider($faker));
        for($i = 1; $i <= 20; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->articleTitle,
                'content' => $faker->paragraph(10),
                'created_at' => $faker->dateTimeThisYear,
                'updated_at' => date("Y.m.d H:i:s"),
            ]);
        }

    }
}
