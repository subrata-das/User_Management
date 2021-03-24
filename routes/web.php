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

Auth::routes();

Route::get('/userRegister', 'Auth\RegisterUserController@showUserRegistrationForm')->name('userRegister');
Route::post('/userRegister', 'Auth\RegisterUserController@registerUser')->name('userRegister');

Route::get('/userInfoRegister', 'Auth\RegisterUserInfoController@showUserInfoRegistrationForm')->name('userInfoRegister');
Route::post('/userInfoRegister', 'Auth\RegisterUserInfoController@registerUserInfo')->name('userInfoRegister');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/userHome', 'UserController@index')->name('userHome');

Route::get('/adminHome', 'AdminController@index')->name('adminHome');
Route::get('/userShow/{id}', 'AdminController@show')->name('userShow');
Route::get('/userEdit/{id}', 'AdminController@edit')->name('userEdit');
Route::put('/userUpdate/{id}', 'AdminController@update')->name('userUpdate');
Route::delete('/userDestroy/{id}', 'AdminController@destroy')->name('userDestroy');

// Route::group(['prefix' => API_ADMIN_PREFIX, 'namespace' => API_ADMIN_NAMESPACE], function () {
    
//     Route::get('/home', 'HomeController@index')->name('home');

// });