<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'image' => 'uploads/products/book.jpg',
        'price' => $faker->numberBetween(100, 1000),
        'description' => $faker->paragraph(4)
    ];
});
