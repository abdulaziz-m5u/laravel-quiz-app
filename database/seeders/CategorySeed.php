<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach(range(1,5) as $id)
        {
            Category::insert([
                'id' => $id,
                'slug'=>Str::random(32),
                'name' => $faker->sentence(3)
            ]);
        }
    }
}
