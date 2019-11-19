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


Auth::routes();

/* tela de login */
Route::get('/', function () { return view('auth/login'); });

/* tela de cadastro de empresas */
Route::get('/cadastro', function () { return view('auth/emp'); });

/* Home - acesso apenas autenticado */
Route::get('/home', 'HomeController@index')->name('home');

/* rotas protegidas de controllers/admin */
Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::resource('usuarios', 'UsuariosController');
    Route::resource('empresas', 'EmpresasController');
});

/* testando cadastro de*/
Route::get('/empresa', 'EmpController@index');
Route::get('/empresa/create', 'EmpController@create');
Route::post('/empresastore', 'EmpController@store');