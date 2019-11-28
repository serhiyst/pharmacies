<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::post('/pharmacies/search', 'PharmacyController@search')->name('search');
Route::get('/pharmacies/custom-search', 'PharmacyController@customSearchForm');
Route::post('/pharmacies/custom-search', 'PharmacyController@customSearch');
Route::get('/pharmacies/selection', 'PharmacyController@selection');
Route::resource('pharmacies', 'PharmacyController');
