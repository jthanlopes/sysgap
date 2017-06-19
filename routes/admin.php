<?php

//Rotas ds dashboard, admins e perfil
Route::get('/', 'AdminController@index')->name('admin.dashboard');
Route::get('/admins-view', 'AdminController@adminsView')->name('admins.view');

// Rotas de login e logout do admin
Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.show-login-form');
Route::post('/login', 'AdminLoginController@login')->name('admin.login');
Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');

// Rotas de registro do admin
Route::get('/register', 'AdminRegisterController@showRegisterForm')->name('admin.show-register-form');
Route::post('/register', 'AdminRegisterController@register')->name('admin.register');

// Rotas de conhecimentos
Route::get('/conhecimentos-view', 'ConhecimentoController@conhecimentosView')->name('conhecimentos.view');
Route::get('/conhecimentos-view/novo', 'ConhecimentoController@conhecimentoNovo')->name('conhecimento.show-form-novo');
Route::post('/conhecimentos-view/novo/cadastrar', 'ConhecimentoController@conhecimentoCadastrar')->name('conhecimento.cadastrar');

