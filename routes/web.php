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

Route::prefix('empresa')->group(function () {	
	// Rotas de logout
	Route::get('/perfil', 'Empresa\EmpresaController@perfil')->name('empresa.perfil');	

  Route::post('/novo', 'Empresa\EmpresaController@empresaNovo')->name('empresa.novo');

  // Submete o formulário de login
	Route::post('/login', 'Empresa\EmpresaController@loginEmpresa')->name('empresa.login');

	// Rotas de logout
	Route::get('/logout', 'Empresa\EmpresaController@logout')->name('empresa.logout');

	// Rotas de job	
	Route::post('/job/novo', 'Empresa\Job\JobController@jobCadastrar')->name('job.novo');

	// Json dos jobs
	Route::get('/jobs/json', 'Empresa\Job\JobController@jobsViewJson')->name('empresa.jobs.json');
});

Auth::routes();