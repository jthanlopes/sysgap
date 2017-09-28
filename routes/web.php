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
})->name('home.page');

Route::get('/eventos', 'Noticia\NoticiaController@noticiasViewHome')->name('eventos.page');
Route::get('/eventos/evento-view/{noticia}', 'Noticia\NoticiaController@noticiaView')->name('evento.view');

Route::get('/contato', function () {
    return view('site.contato');
})->name('contato.page');

Route::prefix('empresa')->group(function () {
	Route::get('/', 'Empresa\EmpresaController@perfil');
	// Rotas de logout
	Route::get('/perfil', 'Empresa\EmpresaController@perfil')->name('empresa.perfil');

  // Abre o formulário de cadastro da empresa
  Route::get('/novo', 'Empresa\EmpresaRegisterController@registroView')->name('empresa.registro-view');

  // Salvar formulário 
  Route::post('/novo', 'Empresa\EmpresaRegisterController@novo')->name('empresa.novo');

  // Abre o formulário de login da empresa
  Route::get('/login', 'Empresa\EmpresaLoginController@loginView')->name('empresa.login-view');

  // Submete o formulário de login
	Route::post('/login', 'Empresa\EmpresaLoginController@login')->name('empresa.login');

	// Rotas de logout
	Route::get('/logout', 'Empresa\EmpresaLoginController@logout')->name('empresa.logout');

	// Rotas de job	
	Route::post('/job/novo', 'Empresa\Job\JobController@novo')->name('job.novo');

	// Json dos jobs
	Route::get('/jobs/json', 'Empresa\Job\JobController@jobsViewJson')->name('empresa.jobs.json');

  // Rotas do projeto
  Route::get('/projetos', 'Empresa\Projeto\ProjetoController@projetosView')->name('projetos.view');
  Route::get('/projeto/novo', 'Empresa\Projeto\ProjetoController@novoProjeto')->name('projeto.show-form-novo');
  Route::post('/projeto/novo/', 'Empresa\Projeto\ProjetoController@criarProjeto')->name('projeto.novo');
});

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