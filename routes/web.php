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

Route::group(['prefix' => 'admin'], function(){
    Route::get('/home', 'Admin\HomeController@index')->name('admin.index');

    Route::group(['prefix' => 'kelola-data'], function(){
        //this route all jarak
        Route::get('/jarak', 'Admin\JarakController@index')->name('admin.jarak.index');
        Route::get('/jarak/get-alamat', 'Admin\JarakController@getAlamat')->name('admin.jarak.get_alamat_fakses');
        Route::post('/jarak/add', 'Admin\JarakController@addJarak')->name('admin.jarak.add');


        //this route all data faskes
        Route::get('/faskes', 'Admin\FaskesController@index')->name('admin.faskes.index');

        //this list data to datatable data faskes
        Route::get('/faskes/list', 'Admin\FaskesController@dataList')->name('admin.faskes.list');

        //this add faskes route
        Route::get('/faskes/add', 'Admin\FaskesController@add')->name('admin.faskes.add');

        //this route edit data faskes
        Route::get('/faskes/edit/{id}', 'Admin\FaskesController@edit')->name('admin.faskes.edit');

        //this route delete data faskes
        Route::get('/faskes/delete/{id}', 'Admin\FaskesController@delete')->name('admin.faskes.delete');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
