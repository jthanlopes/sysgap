<?php

// Rotas do admin ------------------------------------------------------------------------------------------------------------------
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

// Rotas de login do administrador -----------------------------------------------------------------------------------------------------
// Chama o formulário de login
Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.show-login-form');

// Submete o formulário de login
Route::post('/login', 'AdminLoginController@login')->name('admin.login');

// Faz o logout do admin
Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');

// Rotas de registro do admin
// Chama o formulário de cadastro
Route::get('/register', 'AdminRegisterController@showRegisterForm')->name('admin.show-register-form');

// Submete o formulário de cadastro do admin
Route::post('/register', 'AdminRegisterController@register')->name('admin.register');
// -------------------------------------------------------------------------------------------------------------------------------------

// Rotas de conhecimentos ----------------------------------------------------------------------------------------------------------------
// Listagem de todos os conhecimentos
Route::get('/conhecimentos-view', 'Conhecimento\ConhecimentoController@conhecimentosView')->name('conhecimentos.view');

// Pesquisa por conhecimento
Route::post('/conhecimentos-view/pesquisar', 'Conhecimento\ConhecimentoController@conhecimentoPesquisar')->name('conhecimentos.view.pesquisar');

// Chama o formulário de cadastro de conhecimento
Route::get('/conhecimentos-view/novo', 'Conhecimento\ConhecimentoController@conhecimentoNovo')->name('conhecimento.show-form-novo');

// Submete o formulário de cadastro de conhecimento
Route::post('/conhecimentos-view/novo', 'Conhecimento\ConhecimentoController@conhecimentoCadastrar')->name('conhecimento.cadastrar');

// Chama o formulário de edição do conhecimento
Route::get('/conhecimento-view/editar/{conhecimento}', 'Conhecimento\ConhecimentoController@editarForm')->name('conhecimento.show-form-edit');

// Submete o formulário de edição de conhecimento
Route::post('/conhecimento-view/editar', 'Conhecimento\ConhecimentoController@conhecimentoEditar')->name('conhecimento.editar');

// Excluir o conhecimento
Route::get('/conhecimento-view/excluir/{conhecimento}', 'Conhecimento\ConhecimentoController@conhecimentoExcluir')->name('conhecimento.excluir');
// ---------------------------------------------------------------------------------------------------------------------------------------

// Rotas de notícias ---------------------------------------------------------------------------------------------------------------------
Route::get('/noticias-view', 'Noticia\NoticiaController@noticiasView')->name('noticias.view');

// Formulário de cadastro de notícia
Route::get('/noticias-view/novo', 'Noticia\NoticiaController@noticiaNovo')->name('noticia.show-form-novo');

// Salvar formulário de notícia
Route::post('/noticias-view/novo', 'Noticia\NoticiaController@noticiaCadastrar')->name('noticia.cadastrar');

// Inativar notícia
Route::get('/noticia/{noticia}/inativar', 'Noticia\NoticiaController@noticiaInativar')->name('noticia.inativar');

// Ativar notícia
Route::get('/noticia/{noticia}/ativar', 'Noticia\NoticiaController@noticiaAtivar')->name('noticia.ativar');

//------------------------------------------------------------------------------------------------------

// Rotas de empresas
Route::get('/empresas-view', 'Empresa\EmpresaController@empresasView')->name('empresas.view');

//-------------------------------------------------------------------------------------------------------

// Rotas de itens
Route::get('/itens-view', 'Item\ItemController@itensView')->name('itens.view');

// Formulário de cadastro do item (perguntas)
Route::get('/itens-view/novo', 'Item\ItemController@itemNovo')->name('item.show-form-novo');

// Salvar formulário do item (pergunta)
Route::post('/itens-view/novo', 'Item\ItemController@itemCadastrar')->name('item.cadastrar');

// Chama o formulário de edição do item (pergunta)
Route::get('/item-view/editar/{item}', 'Item\ItemController@editarForm')->name('item.show-form-edit');

// Submete o formulário de edição do item (pergunta)
Route::post('/item-view/editar', 'Item\ItemController@itemEditar')->name('item.editar');

// Excluir o item (pergunta)
Route::get('/item-view/excluir/{item}', 'Item\ItemController@itemExcluir')->name('item.excluir');

//------------------------------------------------------------------------------------------------------

// Rotas de freelancer
Route::get('/freelancers-view', 'Freelancer\FreelancerController@freelancersView')->name('freelancers.view');

//-------------------------------------------------------------------------------------------------------

// Rotas dos jobs
Route::get('/jobs-view', 'Job\JobController@jobsView')->name('jobs.view');

//-------------------------------------------------------------------------------------------------------

// Rotas das mensagens
Route::get('/mensagens-view', 'Mensagem\MensagemController@msgView')->name('msg.view');

//-------------------------------------------------------------------------------------------------------

// Rotas de pontuações
Route::get('/pontuacoes-view', 'Pontuacao\PontuacaoController@pontuacoesView')->name('pontuacoes.view');

// Formulário de cadastro de itens de pontuação
Route::get('/pontuacoes-view/novo', 'Pontuacao\PontuacaoController@pontuacaoNovo')->name('pontuacao.show-form-novo');

// Salvar formulário do item de pontuação
Route::post('/pontuacoes-view/novo', 'Pontuacao\PontuacaoController@pontuacaoCadastrar')->name('pontuacao.cadastrar');

// Chama o formulário de edição da pontuação
Route::get('/pontuacao-view/editar/{pontuacao}', 'Pontuacao\PontuacaoController@editarForm')->name('pontuacao.show-form-edit');

// Submete o formulário de edição da pontuação
Route::post('/pontuacao-view/editar', 'Pontuacao\PontuacaoController@pontuacaoEditar')->name('pontuacao.editar');

// Excluir o item de pontução (pergunta)
Route::get('/pontuacao-view/excluir/{pontuacao}', 'Pontuacao\PontuacaoController@pontuacaoExcluir')->name('pontuacao.excluir');

//--------------------------------------------------------------------------------------------------

// Rotas dos gráficos

Route::get('/graficos/cadastros', 'Grafico\GraficoController@graficosCadastros')->name('graficos.cadastros');

//-------------------------------------------------------------------------------------------------------

// Rotas dos grupos
Route::get('/grupos-view', 'Grupo\GrupoController@gruposView')->name('grupos.view.admin');

//-------------------------------------------------------------------------------------------------------