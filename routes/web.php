<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', 'App\Http\Controllers\AuthController@loginView');
    Route::post('loginSubmit', 'App\Http\Controllers\AuthController@login');
});
Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/employees', 'App\Http\Controllers\EmployeeController@list');
        Route::POST('/employees/listAll', 'App\Http\Controllers\EmployeeController@getList');
        Route::get('/employees/add', 'App\Http\Controllers\EmployeeController@saveView');
        Route::POST('/employees/save', 'App\Http\Controllers\EmployeeController@save');
        Route::get('/employees/edit/{id}', 'App\Http\Controllers\EmployeeController@editView');
        Route::POST('/employees/update/{id}', 'App\Http\Controllers\EmployeeController@edit');
        Route::get('/employees/view/{id}', 'App\Http\Controllers\EmployeeController@view');
        Route::delete('/employees/delete/{id}', 'App\Http\Controllers\EmployeeController@delete');
    });
});
Route::POST('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
