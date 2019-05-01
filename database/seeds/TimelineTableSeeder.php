<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TimelineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = \App\User::pluck('id')->toArray();

        foreach (range(1, 128) as $index) {
            $data[] = [
                'user_id'       =>      $faker->randomElement($users),
                'content'       =>      implode('', $faker->paragraphs(random_int(1, 6))),

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }

        \App\Timeline::insert($data);
    }
}
