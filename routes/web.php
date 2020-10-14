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
    return view('admin.index');
})->name("admin-dashboard");


Route::get('/adm/login', 'Admin\Login@index')->name("admin-login");
Route::post('/adm/login', 'Admin\Login@store')->name("admin-login");
Route::get('/adm/logout', 'Admin\Login@logout')->name("admin-logout");

Route::group(['prefix' => 'adm', 'middleware' => 'VerifyAdminLogin'], function () {
    Route::get('/', 'Admin\Dashboard@index')->name("admin-dashboard");

    Route::get('/lote', 'Admin\Lote@index')->name("admin-lote");
    Route::get('/lote/create', 'Admin\Lote@create')->name("admin-lote-create");
    Route::post('/lote/create', 'Admin\Lote@store');
    Route::get('/lote/{id}', 'Admin\Lote@store')->name("admin-lote-show");
    Route::get('/lote/{id}/edit', 'Admin\Lote@edit')->name("admin-lote-edit");
    Route::post('/lote/{id}/edit', 'Admin\Lote@update');


    Route::get('/banner', 'Admin\Dashboard@index')->name("admin-banner");
    
    Route::get('/leilao', 'Admin\Leilao@index')->name("admin-leilao");
    Route::get('/leilao/create', 'Admin\Leilao@create')->name("admin-leilao-create");
    Route::post('/leilao/create', 'Admin\Leilao@store');
    Route::get('/leilao/{id}', 'Admin\Leilao@show')->name("admin-leilao-show");
    Route::get('/leilao/{id}/edit', 'Admin\Leilao@edit')->name("admin-leilao-edit");
    Route::post('/leilao/{id}/edit', 'Admin\Leilao@update');

    
    
    
    
    Route::get('/lance', 'Admin\Dashboard@index')->name("admin-lance");
    Route::get('/arremate', 'Admin\Dashboard@index')->name("admin-arremate");
    Route::get('/cliente', 'Admin\Dashboard@index')->name("admin-cliente");
    Route::get('/user-admin', 'Admin\Dashboard@index')->name("admin-user-admin");
    Route::get('/logs-admin', 'Admin\Dashboard@index')->name("admin-logs-admin");
    Route::get('/logs-cliente', 'Admin\Dashboard@index')->name("admin-logs-cliente");

    
    Route::get('/config', 'Admin\Dashboard@index')->name("admin-site-config");

    
});