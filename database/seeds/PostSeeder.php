<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = \App\User::pluck('id')->toArray();

        foreach (range(1, 100) as $index) {
            // avatar
            $avatarUrl = null;
            if (random_int(0, 1)) {
                if (env('FAKER_IMAGE_STORAGE', false)) {
                    $avatarUrl = $faker->image(storage_path('app/uploads/activity/avatar'), 800, 480);
                    $avatarUrl = strstr($avatarUrl, 'uploads/activity/avatar');
                } else {
                    $avatarUrl = $faker->imageUrl(800, 480, 'fashion');
                }
            }

            $data[] = [
                'title'         =>      $faker->sentence(6),
                'content'       =>      implode('', $faker->paragraphs(random_int(4, 9))),

                'user_id'       =>      random_int(0, 1) ? $faker->randomElement($users) : null,
                'avatar'        =>      $avatarUrl,
                'origin_url'    =>      random_int(0, 1) ? $faker->url() : null,

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }

        \App\Post::insert($data);
    }
}
