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
    return view('welcome');
});

Route::get('/get/menu/list','MenuController@list');
Route::get('/get/menu/{id}','MenuController@detail');
Route::post('/post/menu/save','MenuController@save');
Route::put('/put/menu/update','MenuController@update');
Route::delete('/delete/menu/{id}','MenuController@delete');
Route::get('/get/menu/list','MenuController@list');
Route::get('/get/type_menu/list', 'MenuTypeController@list');

//users routes
Route::get('/get/users','UserController@list');
Route::get('/edit-user/{id}','UserController@detail');
