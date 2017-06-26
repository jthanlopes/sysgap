<?php

//Rotas do admin
// Dashboard do admin
Route::get('/', 'AdminController@index')->name('admin.dashboard');

// Listagem dos admins ativos
Route::get('/admins-view', 'AdminController@adminsView')->name('admins.view');

// Listagens dos admins inativos
Route::get('/admins-view-inativos', 'AdminController@adminsViewInativos')->name('admins.view-inativos');

// Pesquisar nos admins ativo
Route::post('/admins-view/pesquisar', 'AdminController@adminPesquisarAtivos')->name('admins.view.pesquisar');

// Pesquisar nos admins inativos
Route::post('/admins-view-inativos/pesquisar', 'AdminController@adminPesquisarInativos')->name('admins.view-inativos.pesquisar');

// Inativar admin
Route::get('/admin-view/inativar/{admin}', 'AdminRegisterController@adminInativar')->name('admin.inativar');

// Ativar admin
Route::get('/admin-view/ativar/{admin}', 'AdminRegisterController@adminAtivar')->name('admin.ativar');

// Formulário para editar perfil do admin atual
Route::get('/admin-perfil', 'AdminController@adminPerfil')->name('admin.perfil');

// Salvar formulário de edição do admin atual
Route::post('/admin-perfil', 'AdminRegisterController@adminEditarPerfil')->name('admin.perfil.editar');

// Formulário para editar perfil de admin inativo
Route::get('/admin-perfil-inativo/{id}', 'AdminController@adminPerfilInativo')->name('admin.perfil-inativo');

// Salvar formulário de edição de perfil de admin inativo
Route::post('/admin-perfil-inativo', 'AdminRegisterController@adminEditarPerfilInativo')->name('admin.perfil-inativo.editar');


// -------------------------------------------------------------------------------------------------------------------------------------
// Rotas de login
Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.show-login-form');
Route::post('/login', 'AdminLoginController@login')->name('admin.login');

// Rotas de logout
Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');

// Rotas de registro do admin
Route::get('/register', 'AdminRegisterController@showRegisterForm')->name('admin.show-register-form');
Route::post('/register', 'AdminRegisterController@register')->name('admin.register');


// -------------------------------------------------------------------------------------------------------------------------------------
// Rotas de conhecimentos
// Listagem de todos os conhecimentos
Route::get('/conhecimentos-view', 'Conhecimento\ConhecimentoController@conhecimentosView')->name('conhecimentos.view');

// Pesquisa por conhecimento
Route::post('/conhecimentos-view/pesquisar', 'Conhecimento\ConhecimentoController@conhecimentoPesquisar')->name('conhecimentos.view.pesquisar');

// Formulário de cadastro de conhecimento
Route::get('/conhecimentos-view/novo', 'Conhecimento\ConhecimentoController@conhecimentoNovo')->name('conhecimento.show-form-novo');

// Salvar formulário de conhecimento
Route::post('/conhecimentos-view/novo', 'Conhecimento\ConhecimentoController@conhecimentoCadastrar')->name('conhecimento.cadastrar');

// Formulário para editar conhecimento
Route::get('/conhecimento-view/editar/{conhecimento}', 'Conhecimento\ConhecimentoController@editarForm')->name('conhecimento.show-form-edit');

// Salvar formulário de edição de conhecimento
Route::post('/conhecimento-view/editar', 'Conhecimento\ConhecimentoController@conhecimentoEditar')->name('conhecimento.editar');

// Excluir conhecimento
Route::get('/conhecimento-view/excluir/{conhecimento}', 'Conhecimento\ConhecimentoController@conhecimentoExcluir')->name('conhecimento.excluir');


// ---------------------------------------------------------------------------------------------------------------------------------------
// Rotas de notícias
Route::get('/noticias-view', 'Noticia\NoticiaController@noticiasView')->name('noticias.view');
