<?php

use Illuminate\Support\Facades\Auth;
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

 
Auth::routes();

Route::get('/', function() {
    return redirect('/login');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'users'], function () {
    Route::get('/view','Backend\UserController@view')->name('users.view');
    Route::get('/add','Backend\UserController@add')->name('users.add');
    Route::post('/store','Backend\UserController@store')->name('users.store');
    Route::get('/edit/{id}','Backend\UserController@edit')->name('users.edit');
    Route::post('/update/{id}','Backend\UserController@update')->name('users.update');
    Route::delete('/delete/{id}','Backend\UserController@delete')->name('users.delete');
    
});

Route::group(['prefix' => 'suppliers'], function () {
    Route::get('/view','Backend\SupplierController@view')->name('suppliers.view');
    Route::get('/add','Backend\SupplierController@add')->name('suppliers.add');
    Route::post('/store','Backend\SupplierController@store')->name('suppliers.store');
    Route::get('/edit/{id}','Backend\SupplierController@edit')->name('suppliers.edit');
    Route::post('/update/{id}','Backend\SupplierController@update')->name('suppliers.update');
    Route::delete('/delete/{id}','Backend\SupplierController@delete')->name('suppliers.delete');
    
});
Route::group(['prefix' => 'customers'], function () {
    Route::get('/view','Backend\CustomerController@view')->name('customers.view');
    Route::get('/add','Backend\CustomerController@add')->name('customers.add');
    Route::post('/store','Backend\CustomerController@store')->name('customers.store');
    Route::get('/edit/{id}','Backend\CustomerController@edit')->name('customers.edit');
    Route::post('/update/{id}','Backend\CustomerController@update')->name('customers.update');
    Route::delete('/delete/{id}','Backend\CustomerController@delete')->name('customers.delete');
});
Route::group(['prefix' => 'units'], function () {
    Route::get('/view','Backend\UnitController@view')->name('units.view');
    Route::get('/add','Backend\UnitController@add')->name('units.add');
    Route::post('/store','Backend\UnitController@store')->name('units.store');
    Route::get('/edit/{id}','Backend\UnitController@edit')->name('units.edit');
    Route::post('/update/{id}','Backend\UnitController@update')->name('units.update');
    Route::delete('/delete/{id}','Backend\UnitController@delete')->name('units.delete');
});