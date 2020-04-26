<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RaidSignup;
use Faker\Generator as Faker;

$classes = [
    'Warrior' => ['Arms', 'Fury', 'Protection'],
    'Paladin' => ['Holy', 'Retribution', 'Protection'],
    'Mage' => ['Arcane', 'Fire', 'Frost'],
    'Rogue' => ['Assassination', 'Combat', 'Subtlety'],
    'Hunter' => ['Survival', 'Beast Mastery', 'Marksmanship'],
    'Warlock' => ['Affliction', 'Demonology', 'Destruction'],
    'Priest' => ['Discipline', 'Holy', 'Shadow'],
    'Druid' => ['Balance', 'Restoration', 'Feral (DPS)', 'Feral (Tank)'],
    'Shaman' => ['Restoration', 'Enhancement', 'Elemental']
];

$factory->define(RaidSignup::class, function (Faker $faker) use ($classes) {
    $class = $faker->randomElement(array_keys($classes));

    return [
        'character_name' => $faker->firstName,
        'class' => $class,
        'spec' => $faker->randomElement($classes[$class]),
        'douse' => $faker->boolean,
        'note' => $faker->sentences(2, true),
        'confirmed' => $faker->boolean,
    ];
});
