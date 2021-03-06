<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TopicNodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $rootNodes = [];

        $Node = \App\TopicNode::create(['name' => 'Node 1']);
        $rootNodes[] = $Node->makeRoot();

        $Node = \App\TopicNode::create(['name' => 'Node 2']);
        $rootNodes[] = $Node->makeRoot();

        $Node = \App\TopicNode::create(['name' => 'Node 3']);
        $rootNodes[] = $Node->makeRoot();

        foreach (range(1, 16) as $index) {
            $Node = \App\TopicNode::create([
                'name'          =>      $faker->word(),
            ]);

            $Node->makeChildOf($rootNodes[array_rand($rootNodes)]);
        }
    }
}
