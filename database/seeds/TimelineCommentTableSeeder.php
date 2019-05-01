<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TimelineCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $userIds = \App\User::pluck('id')->toArray();
        $timelineIds = \App\Timeline::pluck('id')->toArray();

        foreach (range(1, 500) as $index) {
            $data[] = [
                'user_id'       =>      $faker->randomElement($userIds),
                'timeline_id'   =>      $faker->randomElement($timelineIds),

                'content'       =>      implode('', $faker->paragraphs(random_int(1, 3))),

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }

        \App\TimelineComment::insert($data);
    }
}
