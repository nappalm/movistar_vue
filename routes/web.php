<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::auth();

//Experto ::
Route::post('experto/login', 'ExpertoController@login');
// Route::get('experto', 'ExpertoController@index');

//Embajador ::
Route::post('embajador/login', 'EmbajadorController@login');
// Route::get('embajador', 'EmbajadorController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('{path}','HomeController@index')->where('path','([A-z\d-\/_,]*)?');
