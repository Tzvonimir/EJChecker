<?php

Route::post('/api/authenticate', 'AuthenticateController@authenticate');

Route::group(['middleware' => 'jwt.auth'], function() {

    Route::get('/api/users/default_language', 'UserController@default_language');

    Route::resource('users', 'UserController');
    Route::resource('countries', 'CountryController');
    Route::resource('timezones', 'TimezoneController');
    Route::resource('app_languages', 'AppLanguageController');
    Route::resource('app_configurations', 'AppConfigurationController');
    Route::resource('cities', 'CityController');
    Route::resource('currencies', 'CurrencyController');
    Route::resource('media', 'MediaController');
    Route::resource('numbers', 'NumberController');
	Route::resource('extra_numbers', 'ExtraNumberController');
	Route::resource('combinations', 'CombinationController');
});

Route::group(['prefix' => '/api/open/combinations'], function () {
	Route::post('/check_combination', 'CombinationController@checkCombination');
	Route::get('/get_statistics', 'CombinationController@findStatistics');
	Route::get('/get_winning_combinations', 'CombinationController@getWinningCombinations');
	Route::get('/get_combinations', 'CombinationController@index');
});

Route::group(['prefix' => '/api/open/numbers'], function () {
	Route::get('/get_numbers', 'NumberController@index');
    Route::get('/get_random', 'NumberController@getRandom');
});

Route::group(['prefix' => '/api/open/extra_numbers'], function () {
	Route::get('/get_extra_numbers', 'ExtraNumberController@index');
    Route::get('/get_random', 'ExtraNumberController@getRandom');
});