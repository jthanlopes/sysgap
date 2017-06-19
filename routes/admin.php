<?php

Route::get('/', 'AdminController@index')->name('admin.dashboard');
Route::get('/admins-view', 'AdminController@adminsView')->name('admins.view');
Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');

// Rotas de Login
Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.show-login-form');
Route::post('/login', 'AdminLoginController@login')->name('admin.login');

// Rotas de Registro
Route::get('/register', 'AdminRegisterController@showRegisterForm')->name('admin.show-register-form');
Route::post('/register', 'AdminRegisterController@register')->name('admin.register');

// Rotas de Conhecimentos
Route::get('/conhecimentos-view', 'ConhecimentoController@conhecimentosView')->name('conhecimentos.view');
Route::Post('/conhecimentos-view/novo', 'ConhecimentoController@conhecimentosView')->name('conhecimento.novo');