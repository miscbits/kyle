<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/*
|--------------------------------------------------------------------------
| UserMeta Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Models\UserMeta::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'phone' => $faker->phoneNumber,
        'marketing' => 1,
        'terms_and_cond' => 1,
    ];
});

$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => 'member',
        'label' => 'Member',
    ];
});

/*
|--------------------------------------------------------------------------
| Team Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Models\Team::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->name
    ];
});
/*
|--------------------------------------------------------------------------
| Demographic Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Models\Demographic::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'first_name' => 'laravel',
		'middle_name' => 'laravel',
		'last_name' => 'laravel',
		'email' => 'laravel',
		'phone' => 'laravel',
		'address' => 'laravel',
		'twitter' => 'laravel',
		'ward' => '1',
		'group' => 'laravel',
		'student' => '1',
		'notes' => 'laravel',


    ];
});

/*
|--------------------------------------------------------------------------
| Donation Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Models\Donation::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'amount' => '1.1',
		'contribution_timestamp' => '2017-02-07',
		'demographic_id' => '1',


    ];
});
