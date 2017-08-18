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

Route::get('/contato', function () {
    return view('site.contato');
})->name('contato.page');

Route::prefix('empresa')->group(function () {
	Route::get('/', 'Empresa\EmpresaController@perfil');
	// Rotas de logout
	Route::get('/perfil', 'Empresa\EmpresaController@perfil')->name('empresa.perfil');

  // Salvar formulário 
  Route::post('/novo', 'Empresa\EmpresaRegisterController@novo')->name('empresa.novo');

  // Submete o formulário de login
	Route::post('/login', 'Empresa\EmpresaLoginController@login')->name('empresa.login');

	// Rotas de logout
	Route::get('/logout', 'Empresa\EmpresaLoginController@logout')->name('empresa.logout');

	// Rotas de job	
	Route::post('/job/novo', 'Empresa\Job\JobController@novo')->name('job.novo');

	// Json dos jobs
	Route::get('/jobs/json', 'Empresa\Job\JobController@jobsViewJson')->name('empresa.jobs.json');
});

Route::prefix('freelancer')->group(function () { 
  Route::get('/', 'Freelancer\FreelancerController@perfil');
  // Rotas de logout
  Route::get('/perfil', 'Freelancer\FreelancerController@perfil')->name('freelancer.perfil');

  // Salvar formulário
  Route::post('/novo', 'Freelancer\FreelancerRegisterController@novo')->name('freelancer.novo');

  // Submete o formulário de login
  Route::post('/login', 'Freelancer\FreelancerLoginController@login')->name('freelancer.login');

  // Rotas de logout
  Route::get('/logout', 'Freelancer\FreelancerLoginController@logout')->name('freelancer.logout');
});

Auth::routes();