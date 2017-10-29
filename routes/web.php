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

// Rota da home-page do site
Route::get('/', 'HomeController@home')->name('home.page');
// Visualizar todos os eventos
Route::get('/eventos', 'Noticia\NoticiaController@noticiasViewHome')->name('eventos.page');
// Visualizar um único evento
Route::get('/eventos/evento-view/{noticia}', 'Noticia\NoticiaController@noticiaView')->name('evento.view');
// Rota do formulário de contato com o admin
Route::get('/contato', function () {return view('site.contato');})->name('contato.page');

// Rotas de empresa
Route::prefix('empresa')->group(function () {
	// Rota de perfil da empresa
  Route::get('/', 'Empresa\EmpresaController@perfil');
	// Rotas de logout
	Route::get('/perfil', 'Empresa\EmpresaController@perfil')->name('empresa.perfil');
  // Abre o formulário de cadastro da empresa
  Route::get('/novo', 'Empresa\EmpresaRegisterController@registroView')->name('empresa.registro-view');
  // Salvar formulário 
  Route::post('/novo', 'Empresa\EmpresaRegisterController@novo')->name('empresa.novo');
  // Confirmação de conta da empresa
  // Route::get('/confirmaConta/{email}', 'Empresa\EmpresaRegisterController@confirmaConta')->name('empresa.confirma-conta');
  // Abre o formulário de login da empresa
  Route::get('/login', 'Empresa\EmpresaLoginController@loginView')->name('empresa.login-view');
  // Submete o formulário de login
	Route::post('/login', 'Empresa\EmpresaLoginController@login')->name('empresa.login');
	// Rotas de logout
	Route::get('/logout', 'Empresa\EmpresaLoginController@logout')->name('empresa.logout');
  // Abrir formulário de editar perfil
  Route::get('/editar-perfil', 'Empresa\EmpresaController@editarPerfil')->name('empresa.editar-perfil.view');
  // Rotas do projeto
  Route::get('/projetos', 'Empresa\Projeto\ProjetoController@projetosView')->name('projetos.view');
  // Pesquisar por projeto
  Route::post('/projetos/pesquisar', 'Empresa\Projeto\ProjetoController@projetosPesquisar')->name('projetos.view.pesquisar');
  // Exibir formulário para cadastrar um novo projeto
  Route::get('/projeto/novo/', 'Empresa\Projeto\ProjetoController@novoProjeto')->name('projeto.show-form-novo');
  // Submeter e criar um novo projeto
  Route::post('/projeto/novo/', 'Empresa\Projeto\ProjetoController@criarProjeto')->name('projeto.novo');
  // Visualizar um projeto
  Route::get('/projeto/{projeto}', 'Empresa\Projeto\ProjetoController@viewProjeto')->name('view.projeto');
  // Abrir formulário para editar um projeto
  Route::get('/projeto/editar/{projeto}', 'Empresa\Projeto\ProjetoController@editarProjetoView')->name('view.projeto-editar');
  // Submeter e atualizar projeto
  Route::post('/projeto/editar/', 'Empresa\Projeto\ProjetoController@editarProjeto')->name('projeto.editar');
  // Rotas de jobs
  // Abrir formulário de criação do Job
  Route::get('/projeto/{projeto}/job/novo', 'Empresa\Job\JobController@novoForm')->name('job.novo.form');
  // Salvar Job
  Route::post('/projeto/job/novo', 'Empresa\Job\JobController@novo')->name('job.novo');
  // 
  Route::get('/projeto/{projeto}/job/{job}', 'Empresa\Job\JobController@jobView')->name('job.view');
  // Abrir formulário de editar job
  Route::get('/projeto/job/editar/{job}', 'Empresa\Job\JobController@editarJobView')->name('view.job-editar');
  //
  Route::post('/projeto/job/editar', 'Empresa\Job\JobController@editarJob')->name('job.editar');
  // Finalizar job
  Route::get('/projeto/{projeto}/job/finalizar/{job}', 'Empresa\Job\JobController@finalizarJob')->name('job.finalizar');
  // Reabrir job
  Route::get('/projeto/{projeto}/job/reabrir/{job}', 'Empresa\Job\JobController@reabrirJob')->name('job.reabrir');
  // Rotas para adicionar membros ao projeto
  // Abrir formulário de adição de membros
  Route::get('/projeto/{projeto}/integrante/novo', 'Empresa\Projeto\ProjetoController@novoFormIntegrantes')->name('integrante.novo.form');
  // Pesquisar por membros
  Route::post('/projeto/{projeto}/integrante/pesquisar', 'Empresa\Projeto\ProjetoController@pesquisarIntegrantes')->name('integrante.pesquisar.form');
  // Adicionar freelancer e produtora ao projeto
  Route::get('/projeto/{projeto}/integrante/addFreelancer/{freelancer}', 'Empresa\Projeto\ProjetoController@addFreelancer')->name('integrante.add-freelancer.form');
  Route::get('/projeto/{projeto}/integrante/addProdutora/{empresa}', 'Empresa\Projeto\ProjetoController@addProdutora')->name('integrante.add-produtora.form');
  // Remover freelancer e produtora ao projeto
  Route::get('/projeto/{projeto}/integrante/remover/{freelancer}', 'Empresa\Projeto\ProjetoController@removerFreelancer')->name('integrante.remover-freelancer.form');
  Route::get('/projeto/{projeto}/integrante/remover-produtora/{empresa}', 'Empresa\Projeto\ProjetoController@removerProdutora')->name('integrante.remover-produtora.form');
  // Rotas de notícias e eventos
  // Submeter e criar uma nova notícia
  Route::post('/noticias/novo/', 'Empresa\Noticia\NoticiaController@criarNoticia')->name('noticia.novo');
  // Excluir notícia/evento
  Route::get('/noticia/excluir/{noticia}', 'Empresa\Noticia\NoticiaController@excluirNoticia')->name('noticia.excluir');
  // Rotas de conhecimentos
  //
  Route::get('/conhecimentos', 'Empresa\Conhecimento\ConhecimentoController@conhecimentosView')->name('tecnologias.view');
  //
  Route::post('/conhecimento/add', 'Empresa\Conhecimento\ConhecimentoController@addConhecimento')->name('conhecimento.add');
  //
  Route::get('/conhecimento/excluir/{conhecimento}', 'Empresa\Conhecimento\ConhecimentoController@excluirConhecimento')->name('conhecimento.excluir');
});

// Rotas de freelancer
Route::prefix('freelancer')->group(function () {
  Route::get('/', 'Freelancer\FreelancerController@perfil');
  // Rotas de logout
  Route::get('/perfil', 'Freelancer\FreelancerController@perfil')->name('freelancer.perfil');

  // Abre o formulário de cadastro do freelancer
  Route::get('/novo', 'Freelancer\FreelancerRegisterController@registroView')->name('freelancer.registro-view');

  // Salvar formulário
  Route::post('/novo', 'Freelancer\FreelancerRegisterController@novo')->name('freelancer.novo');

  // Abre o formulário de login do freelancer
  Route::get('/login', 'Freelancer\FreelancerLoginController@loginView')->name('freelancer.login-view');

  // Submete o formulário de login
  Route::post('/login', 'Freelancer\FreelancerLoginController@login')->name('freelancer.login');

  // Rotas de logout
  Route::get('/logout', 'Freelancer\FreelancerLoginController@logout')->name('freelancer.logout');
});

Auth::routes();