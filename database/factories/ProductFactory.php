<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {

    return [
        'category_id' => function () {
            $idCategories = \App\Models\Category::where('parent_id', '>', 0)->pluck('id')->toArray();
            return $idCategories[array_rand($idCategories)];
        },
        'name' => $faker->name,
        'slug' => str_slug($faker->name),
        'description' => $faker->paragraph(2, true),
        'quantity' => rand(5, 20),
        'discount' => 0,
        'rating' => rand(0, 5),
        'price' => rand(10, 100),
    ];
});
