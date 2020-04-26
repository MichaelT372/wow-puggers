<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Raid;
use Faker\Generator as Faker;

$factory->define(Raid::class, function (Faker $faker) {
    $location = $faker->randomElement(["Molten Core", "Zul'Gurub", "Blackwing Lair"]);

    return [
        'faction' => $faker->randomElement(['Horde', 'Alliance']),
        'location' => $location,
        'description' => $faker->paragraphs(3, true),
        'loot_rules' => $faker->paragraphs(2, true),
        'soft_reserves' => true,
        'start_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i'),
        'leader_id' => 1
    ];
});
