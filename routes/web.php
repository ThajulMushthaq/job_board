<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\JobsController@index');
Route::post('/jobs/store', 'App\Http\Controllers\JobsController@store');
Route::get('/jobs/show/{id?}', 'App\Http\Controllers\JobsController@show');

Route::post('/candidates/store', 'App\Http\Controllers\CandidatesController@store');
