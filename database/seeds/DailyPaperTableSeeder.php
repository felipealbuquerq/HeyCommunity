<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DailyPaperTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $news = \App\News::select('id')->get();
        $topics = \App\Topic::select('id')->get();
        $activities = \App\Activity::select('id')->get();

        foreach (range(1, 60) as $index) {
            $key = array_random(['news', 'topics', 'activities']);
            $entity = $$key->pop();


            if ($entity) {
                $data[] = [
                    'entity_type'   =>      $entity->getMorphClass(),
                    'entity_id'     =>      $entity->id,
                    'remark'        =>      $faker->sentence(),

                    'created_at'    =>      $faker->dateTimeThisMonth(),
                    'updated_at'    =>      $faker->dateTimeThisMonth(),
                ];
            }
        }

        \App\DailyPaper::insert($data);
    }
}
