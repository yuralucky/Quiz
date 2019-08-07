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
Route::get('/','QuizController@index');

Route::get('/start', 'QuizController@index');
Route::post('/start', 'QuizController@store')->name('store');

Route::get('/page2','QuizController@page2')->name('page2');

Route::get('/page3','QuizController@page3')->name('page3');

Route::get('/page4','QuizController@page4');
Route::post('/page4','QuizController@page4')->name('page4');

Route::get('/page5','QuizController@page5');
Route::post('/page5','QuizController@page5')->name('page5');

Route::get('/finish','QuizController@finish')->name('end');
Route::post('/finish','QuizController@actionPage5')->name('finish');


