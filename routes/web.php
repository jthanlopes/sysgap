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
    return view('site.home');
});

Auth::routes();

Route::prefix('admin')->group(function () {    
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	Route::get('/admins-view', 'AdminController@adminsView')->name('admins.view');
	Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');

	// Rotas de Login
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.show-login-form');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');

	// Rotas de Registro
	Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.show-register-form');
	Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register');

	// Rotas de Conhecimentos
	Route::get('/conhecimentos-view', 'ConhecimentoController@conhecimentosView')->name('conhecimentos.view');
	Route::Post('/conhecimentos-view/novo', 'ConhecimentoController@conhecimentosView')->name('conhecimento.novo');

});