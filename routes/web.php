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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'ViewController@index');

Route::get('/poolstats/api/{pool_name}', 'ViewController@poolStats');
Route::get('/networkstats/api', 'ViewController@networkStats');


Route::get('superiorcoinpool/api', 'ViewController@superiorcoinpool');
Route::get('/newnetworks/api', 'ViewController@newNetwork');

Route::get('/thritydaysnetwork', 'ViewController@thrityDaysNetwork');

Route::get('/sort-year', 'ViewController@sortYear');
Route::post('/date', 'ViewController@sortDate');