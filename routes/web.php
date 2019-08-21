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
Route::get('/', 'ViewController@start');
Route::get('test','ViewController@test');


Route::get('/start', 'ViewController@start');
Route::post('/start', 'ViewController@logicStart')->name('start');

Route::get('/page2', 'ViewController@viewPage2');
Route::post('/page2', 'ViewController@logicPage2')->name('page2');

Route::get('/page3', 'ViewController@viewPage3');
Route::post('/page3', 'ViewController@logicPage3')->name('page3');

Route::get('/page4', 'ViewController@viewPage4');
Route::post('/page4', 'ViewController@logicPage4')->name('page4');

Route::get('/page5', 'ViewController@viewPage5');
Route::post('/page5', 'ViewController@logicPage5')->name('page5');

Route::get('/finish', 'ViewController@finish');
Route::post('/finish', 'ViewController@finish')->name('finish');



Route::get('rating','ViewController@rating');


