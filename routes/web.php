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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/persebaran', 'IndexController@persebaran')->name('persebaran');
Route::get('/persebaran/list', 'IndexController@persebaranList')->name('persebaran.list');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin']], function(){
    Route::get('/home', 'Admin\HomeController@index')->name('admin.index');

    //this route all data user
    Route::get('/user', 'Admin\UsersController@index')->name('admin.user.index');
    Route::get('/user/list', 'Admin\UsersController@listUser')->name('admin.user.list');
    Route::get('/user/add', 'Admin\UsersController@add')->name('admin.user.add');
    Route::post('/user/add/do', 'Admin\UsersController@addDo')->name('admin.user.add.do');
    Route::get('/user/edit/{id}', 'Admin\UsersController@edit')->name('admin.user.edit');
    Route::post('/user/edit/do/{id}', 'Admin\UsersController@editDo')->name('admin.user.edit.do');
    Route::get('/user/reset-pw/{id}', 'Admin\UsersController@resetPw')->name('admin.user.reset_pw');
    Route::get('/user/delete/{id}', 'Admin\UsersController@delete')->name('admin.user.delete');

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


        //this route all data kecamatan
        Route::get('/kecamatan', 'Admin\KecamatanController@index')->name('admin.kecamatan.index');
        Route::get('/kecamatan/list', 'Admin\KecamatanController@listKecamatan')->name('admin.kecamatan.list');
        Route::get('/kecamatan/add', 'Admin\KecamatanController@add')->name('admin.kecamatan.add');
        Route::post('/kecamatan/add/do', 'Admin\KecamatanController@addDo')->name('admin.kecamatan.add.do');
        Route::get('/kecamatan/edit/{id}', 'Admin\KecamatanController@edit')->name('admin.kecamatan.edit');
        Route::post('/kecamatan/edit/do/{id}', 'Admin\KecamatanController@editDo')->name('admin.kecamatan.edit.do');
        Route::get('/kecamatan/delete/{id}', 'Admin\KecamatanController@delete')->name('admin.kecamatan.delete');


        //this route all data kelurahan
        Route::get('/kelurahan', 'Admin\KelurahanController@index')->name('admin.kelurahan.index');
        Route::get('/kelurahan/list', 'Admin\KelurahanController@listKelurahan')->name('admin.kelurahan.list');
        Route::get('/kelurahan/add', 'Admin\KelurahanController@add')->name('admin.kelurahan.add');
        Route::post('/kelurahan/add/do', 'Admin\KelurahanController@addDo')->name('admin.kelurahan.add.do');
        Route::get('/kelurahan/edit/{id}', 'Admin\KelurahanController@edit')->name('admin.kelurahan.edit');
        Route::post('/kelurahan/edit/do/{id}', 'Admin\KelurahanController@editDo')->name('admin.kelurahan.edit.do');
        Route::get('/kelurahan/delete/{id}', 'Admin\KelurahanController@delete')->name('admin.kelurahan.delete');


        //this route all data kabupaten
        Route::get('/kabupaten', 'Admin\KabupatenController@index')->name('admin.kabupaten.index');
        Route::get('/kabupaten/list', 'Admin\KabupatenController@listKabupaten')->name('admin.kabupaten.list');
        Route::get('/kabupaten/add', 'Admin\KabupatenController@add')->name('admin.kabupaten.add');
        Route::post('/kabupaten/add/do', 'Admin\KabupatenController@addDo')->name('admin.kabupaten.add.do');
        Route::get('/kabupaten/edit/{id}', 'Admin\KabupatenController@edit')->name('admin.kabupaten.edit');
        Route::post('/kabupaten/edit/do/{id}', 'Admin\KabupatenController@editDo')->name('admin.kabupaten.edit.do');
        Route::get('/kabupaten/delete/{id}', 'Admin\KabupatenController@delete')->name('admin.kabupaten.delete');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
