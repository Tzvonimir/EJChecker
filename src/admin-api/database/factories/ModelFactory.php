<?php

use App\Models\AppConfiguration;
use App\Models\AppLanguage;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Timezone;
use App\Models\User;
use App\Models\Media;
use App\Models\Number;
use App\Models\ExtraNumber;
use App\Models\Combination;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'first_name' => $faker->firstName,
        'middle_name' => $faker->optional(0.1, null)->firstName,
        'last_name' => $faker->firstName,
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'is_active' => $faker->optional(0.9, 0)->numberBetween(1, 1),
    ];
});

$factory->define(Country::class, function (Faker\Generator $faker) {
    return [
        'iso' => $faker->unique()->countryCode,
        'name' => $faker->unique()->country
    ];
});

$factory->define(Timezone::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->timezone
    ];
});

$factory->define(AppLanguage::class, function () {
    return [
        'name' => str_random(5)
    ];
});

$factory->define(AppConfiguration::class, function () {
    return [
        'key' => str_random(10),
        'value' => str_random(10),
        'user_id' => User::all()->random(1)->first()->id
    ];
});

$factory->define(City::class, function () {
    return [
        'name' => str_random(10),
        'country_id' => Country::all()->random(1)->first()->id
    ];
});

$factory->define(Currency::class, function (Faker\Generator $faker) {
    return [
        'iso' => $faker->unique()->currencyCode,
        'name' => str_random(10)
    ];
});

$factory->define(Number::class, function (Faker\Generator $faker) {
    return [
        'number' => $faker->unique()->numberBetween($min = 1, $max = 50),
    ];
});

$factory->define(ExtraNumber::class, function (Faker\Generator $faker) {
    return [
        'number' => $faker->unique()->numberBetween($min = 1, $max = 20),
    ];
});

$factory->define(Media::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random(25),
        'description' => str_random(25),
        'original_filename' => str_random(25),
        'filename' => str_random(25),
        'mime_type' => str_random(25),
        'filesize' => $faker->unique()->randomDigit,
        'uploaded_by_id' => User::all()->random(1)->first()->id,
        'documentable_id' => Number::all()->random(1)->first()->id,
        'documentable_type' => Number::class
    ];
});

$factory->define(Combination::class, function (Faker\Generator $faker) {
    return [
        'first_number' => Number::all()->random(1)->first()->id,
        'second_number' => Number::all()->random(1)->first()->id,
        'third_number' => Number::all()->random(1)->first()->id,
        'fourth_number' => Number::all()->random(1)->first()->id,
        'fifth_number' => Number::all()->random(1)->first()->id,
        'first_extra_number' => ExtraNumber::all()->random(1)->first()->id,
        'second_extra_number' => ExtraNumber::all()->random(1)->first()->id
    ];
});