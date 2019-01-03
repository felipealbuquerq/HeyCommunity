<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = \App\User::pluck('id')->toArray();

        // columnist
        foreach (range(1, 10) as $index) {
            $columnistData[] = [
                'user_id'       =>      $faker->randomElement($users),
                'domain'        =>      $faker->domainWord(),
                'title'         =>      $faker->sentence(2),
                'introduction'  =>      $faker->paragraph(),
                'description'   =>      $faker->paragraph(),

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }
        \App\Columnist::insert($columnistData);

        // column
        $columnists = \App\Columnist::all();

        foreach (range(1, 200) as $index) {
            $columnist = $columnists->random();

            $columnData[] = [
                'columnist_id'  =>      $columnist->id,
                'user_id'       =>      $columnist->user_id,
                'title'         =>      $faker->sentence(6),
                'content'       =>      implode('', $faker->paragraphs(random_int(4, 9))),

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }
        \App\Column::insert($columnData);
    }
}
