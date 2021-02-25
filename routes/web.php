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
        Route::get('/jarak/cek', 'Admin\JarakController@cek')->name('admin.jarak.cek');


        //this route all data faskes
        Route::get('/faskes', 'Admin\FaskesController@index')->name('admin.faskes.index');
        Route::get('/faskes/list', 'Admin\FaskesController@dataList')->name('admin.faskes.list');
        Route::get('/faskes/add', 'Admin\FaskesController@add')->name('admin.faskes.add');
        Route::post('/faskes/add/do', 'Admin\FaskesController@addDo')->name('admin.faskes.add.do');
        Route::get('/faskes/edit/{id}', 'Admin\FaskesController@edit')->name('admin.faskes.edit');
        Route::post('/faskes/edit/do/{id}', 'Admin\FaskesController@editDo')->name('admin.faskes.edit.do');
        Route::get('/faskes/delete/{id}', 'Admin\FaskesController@delete')->name('admin.faskes.delete');


        //this route all data jenis faskes
        Route::get('/jenis-faskes', 'Admin\JenisController@index')->name('admin.jenis_faskes.index');
        Route::get('/jenis-faskes/list', 'Admin\JenisController@listJenis')->name('admin.jenis_faskes.list');
        Route::get('/jenis-faskes/add', 'Admin\JenisController@add')->name('admin.jenis_faskes.add');
        Route::post('/jenis-faskes/add/do', 'Admin\JenisController@addDo')->name('admin.jenis_faskes.add.do');
        Route::get('/jenis-faskes/edit/{id}', 'Admin\JenisController@edit')->name('admin.jenis_faskes.edit');
        Route::post('/jenis-faskes/edit/do/{id}', 'Admin\JenisController@editDo')->name('admin.jenis_faskes.edit.do');
        Route::get('/jenis-faskes/delete/{id}', 'Admin\JenisController@delete')->name('admin.jenis_faskes.delete');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
