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
  Route::get('/confirmaConta/{token}', 'Empresa\EmpresaRegisterController@confirmaConta')->name('empresa.confirma-conta');
  // Abre o formulário de login da empresa
  Route::get('/login', 'Empresa\EmpresaLoginController@loginView')->name('empresa.login-view');
  // Submete o formulário de login
  Route::post('/login', 'Empresa\EmpresaLoginController@login')->name('empresa.login');
	// Rotas de logout
  Route::get('/logout', 'Empresa\EmpresaLoginController@logout')->name('empresa.logout');
  // Resetar senha
  Route::post('/resetar-senha/email', 'Empresa\EmpresaForgotPasswordController@sendResetLinkEmail')->name('empresa.reseta-senha.email');
  Route::get('/resetar-senha/resetar', 'Empresa\EmpresaForgotPasswordController@showLinkRequestForm')->name('empresa.reseta-senha.request');
  Route::post('/resetar-senha/resetar', 'Empresa\EmpresaResetPasswordController@reset');
  Route::get('/resetar-senha/resetar/{token}', 'Empresa\EmpresaResetPasswordController@showResetForm')->name('empresa.reseta-senha.reset');
  // Abrir formulário de editar perfil
  Route::get('/editar-perfil', 'Empresa\EmpresaController@editarPerfil')->name('empresa.editar-perfil.view');
  //
  Route::post('/editar-perfil/informacoes-pessoais', 'Empresa\EmpresaController@editarInfomacoes');
  //
  Route::post('/editar-perfil/endereco', 'Empresa\EmpresaController@editarEndereco')->name('empresa.editar.endereco');
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
  // Mostrar integrantes para add ao job
  Route::get('/projeto/{projeto}/job/{job}/integrante/novo', 'Empresa\Job\JobController@novoFormIntegrantes')->name('job.add.integrantes.form');
  // Adicionar freelancer ao job
  Route::get('/projeto/{projeto}/job/{job}/integrante/{freelancer}/add', 'Empresa\Job\JobController@addFreelancer')->name('job.add.integrante');
  // Adicionar produtora ao job
  Route::get('/projeto/{projeto}/job/{job}/integrante-produtora/{empresa}/add', 'Empresa\Job\JobController@addProdutora')->name('job.add.integrante-produtora');
  // Remover freelancer e produtora do job
  Route::get('/projeto/{projeto}/job/{job}/integrante/{freelancer}/remover', 'Empresa\Job\JobController@removerFreelancer')->name('job.remover-freelancer');
  // Remover produtora
  Route::get('/projeto/{projeto}/job/{job}/integrante-produtora/{empresa}/remover', 'Empresa\Job\JobController@removerProdutora')->name('job.remover-produtora');
  //
  Route::post('/projeto/{projeto}/job/{job}/conhecimento/add', 'Empresa\Job\JobController@addConhecimento')->name('job.conhecimento.add');
  //
  Route::get('/projeto/{projeto}/job/{job}/conhecimento/{conhecimento}/remover', 'Empresa\Job\JobController@removerConhecimento')->name('job.conhecimento.remover');
  // Rotas para adicionar membros ao projeto
  // Abrir formulário de adição de membros
  Route::get('/projeto/{projeto}/integrante/novo', 'Empresa\Projeto\ProjetoController@novoFormIntegrantes')->name('integrante.novo.form');
  // Pesquisar por membros
  Route::post('/projeto/{projeto}/integrante/pesquisar', 'Empresa\Projeto\ProjetoController@pesquisarIntegrantes')->name('integrante.pesquisar.form');
  // Adicionar freelancer e produtora ao projeto
  Route::get('/projeto/{projeto}/integrante/addFreelancer/{freelancer}', 'Empresa\Projeto\ProjetoController@addFreelancer')->name('integrante.add-freelancer.form');
  Route::get('/projeto/{projeto}/integrante/addProdutora/{empresa}', 'Empresa\Projeto\ProjetoController@addProdutora')->name('integrante.add-produtora.form');
  // Remover freelancer e produtora do projeto
  Route::get('/projeto/{projeto}/integrante/remover/{freelancer}', 'Empresa\Projeto\ProjetoController@removerFreelancer')->name('integrante.remover-freelancer.form');
  Route::get('/projeto/{projeto}/integrante/remover-produtora/{empresa}', 'Empresa\Projeto\ProjetoController@removerProdutora')->name('integrante.remover-produtora.form');
  // Finalizar projeto
  Route::get('/projeto/{projeto}/finalizar', 'Empresa\Projeto\ProjetoController@finalizarProjetoView')->name('projeto-view.finalizar');
  //
  // Rotas de pesquisa de usuários
  // Abrir formulário de pesquisa
  Route::get('/pesquisar', 'Empresa\Pesquisa\PesquisaController@pesquisarView')->name('pesquisa.form.usuarios');
  // Subemeter fomulário de pesquisa
  Route::post('/pesquisar', 'Empresa\Pesquisa\PesquisaController@pesquisar')->name('pesquisa.usuarios');
  // Visualizar perfil de uma produtora
  Route::get('/pesquisa/perfil-produtora/{produtora}', 'Empresa\Pesquisa\PesquisaController@viewPerfilProdutora')->name('view.perfil-produtora');
  // Visualizar perfil de um freelancer
  Route::get('/pesquisa/perfil-freelancer/{freelancer}', 'Empresa\Pesquisa\PesquisaController@viewPerfilFreelancer')->name('view.perfil-freelancer');
  // Visualizar perfil/conhecimentos de um freelancer
  Route::get('/pesquisa/perfil-freelancer/conhecimentos/{freelancer}', 'Empresa\Pesquisa\PesquisaController@viewConhecimentosFreelancer')->name('view.conhecimentos-freelancer');
  // Visualizar portifolio de um freelancer
  Route::get('/pesquisa/perfil-freelancer/portifolios/{freelancer}', 'Empresa\Pesquisa\PesquisaController@viewPortifoliosFreelancer')->name('view.portifolios-freelancer');
  // Visualizar perfil/conhecimentos de uma produtora
  Route::get('/pesquisa/perfil-produtora/conhecimentos/{empresa}', 'Empresa\Pesquisa\PesquisaController@viewConhecimentosProdutora')->name('view.conhecimentos-empresa');
  // Visualizar portifolio de uma produtora
  Route::get('/pesquisa/perfil-produtora/portifolios/{empresa}', 'Empresa\Pesquisa\PesquisaController@viewPortifoliosProdutora')->name('view.portifolios-produtora');
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

  // Rotas pra gerar PDFs
  // PDF do projeto
  Route::get('/projeto/{projeto}/pdf', 'pdfController@pdfProjeto')->name('pdf.projeto');
  // PDF do job
  Route::get('/job/{job}/pdf', 'pdfController@pdfJob')->name('pdf.job');

  // Rotas de portifólio
  Route::get('/portifolios', 'Empresa\Portifolio\PortifolioController@portifoliosView')->name('portifolios.view.empresa');
  //
  Route::get('/portifolio/novo', 'Empresa\Portifolio\PortifolioController@criarPortifolioView')->name('portifolio.novo.empresa');
  //
  Route::post('/portifolio/novo', 'Empresa\Portifolio\PortifolioController@criarPortifolio')->name('portifolio.criar.empresa');
  // Excluir portifólio
  Route::get('/portifolio/{portifolio}/excluir', 'Empresa\Portifolio\PortifolioController@excluirPortifolio')->name('portifolio.excluir.empresa');
  // Abrir formulário de editar portifólio
  Route::get('/portifolio/{portifolio}/editar', 'Empresa\Portifolio\PortifolioController@editarPortifolioView')->name('portifolio.editar.view.empresa');
  // Editar portifólio
  Route::post('/portifolio/editar', 'Empresa\Portifolio\PortifolioController@editarPortifolio')->name('portifolio.editar.empresa');
  // Rotas jobs produtora
  // Visualizar todos os jobs
  Route::get('/jobs', 'Empresa\Job\JobController@jobsView')->name('jobs.view.produtora');
  // Visualizar os jobs por projeto
  Route::get('/jobs-projetos', 'Empresa\Job\JobController@jobsViewProjeto')->name('jobs-projeto.view.produtora');
  // Visualizar os jobs de um projeto
  Route::get('/jobs-projetos/{projeto}', 'Empresa\Job\JobController@jobsView');
  // Aceitar projeto
  Route::get('/jobs-projetos/{projeto}/aceitar', 'Empresa\Job\JobController@aceitarProjeto');
  // Recusar projeto
  Route::get('/jobs-projetos/{projeto}/recusar', 'Empresa\Job\JobController@recusarProjeto');
  // Visualizar job
  Route::get('/job/{job}', 'Empresa\Job\JobController@jobViewProdutora')->name('job.view.produtora');
});


// Rotas de freelancer
Route::prefix('freelancer')->group(function () {
  // Rotas do perfil de freelancer
  Route::get('/', 'Freelancer\FreelancerController@perfil');
  // Abrir formulário de editar perfil
  Route::get('/editar-perfil', 'Freelancer\FreelancerController@editarPerfil')->name('freelancer.editar-perfil.view');
  //
  Route::post('/editar-perfil/informacoes-pessoais', 'Freelancer\FreelancerController@editarInfomacoes');
  //
  Route::post('/editar-perfil/endereco', 'Freelancer\FreelancerController@editarEndereco')->name('freelancer.editar.endereco');
  // Rotas de logout
  Route::get('/perfil', 'Freelancer\FreelancerController@perfil')->name('freelancer.perfil');

  // Abre o formulário de cadastro do freelancer
  Route::get('/novo', 'Freelancer\FreelancerRegisterController@registroView')->name('freelancer.registro-view');

  // Salvar formulário
  Route::post('/novo', 'Freelancer\FreelancerRegisterController@novo')->name('freelancer.novo');

  // Confirmação de conta do freelancer
  Route::get('/confirmaConta/{token}', 'Freelancer\FreelancerRegisterController@confirmaConta')->name('freelancer.confirma-conta');

  // Abre o formulário de login do freelancer
  Route::get('/login', 'Freelancer\FreelancerLoginController@loginView')->name('freelancer.login-view');

  // Submete o formulário de login
  Route::post('/login', 'Freelancer\FreelancerLoginController@login')->name('freelancer.login');

  // Rotas de logout
  Route::get('/logout', 'Freelancer\FreelancerLoginController@logout')->name('freelancer.logout');
  // Rotas de conhecimentos do freelancer
  //
  Route::get('/conhecimentos', 'Freelancer\Conhecimento\ConhecimentoController@conhecimentosView')->name('tecnologias.view.freelancer');
  //
  Route::post('/conhecimento/add', 'Freelancer\Conhecimento\ConhecimentoController@addConhecimento')->name('conhecimento.add.freelancer');
  //
  Route::get('/conhecimento/excluir/{conhecimento}', 'Freelancer\Conhecimento\ConhecimentoController@excluirConhecimento')->name('conhecimento.excluir.freelancer');
  // Rotas de notícias e eventos
  // Submeter e criar uma nova notícia
  Route::post('/noticias/novo/', 'Freelancer\Noticia\NoticiaController@criarNoticia')->name('noticia.novo.freelancer');
  // Excluir notícia/evento
  Route::get('/noticia/excluir/{noticia}', 'Freelancer\Noticia\NoticiaController@excluirNoticia')->name('noticia.excluir.freelancer');
  // Rotas dos jobs
  // Visualizar todos os jobs
  Route::get('/jobs', 'Freelancer\Job\JobController@jobsView')->name('jobs.view.freelancer');
  // Visualizar os jobs por projeto
  Route::get('/jobs-projetos', 'Freelancer\Job\JobController@jobsViewProjeto')->name('jobs.projeto.view');
  // Visualizar os jobs de um projeto
  Route::get('/jobs-projetos/{projeto}', 'Freelancer\Job\JobController@jobsView')->name('jobs.projeto.pesquisa');
  // Aceitar projeto
  Route::get('/jobs-projetos/{projeto}/aceitar', 'Freelancer\Job\JobController@aceitarProjeto')->name('jobs.projeto.aceitar');
  // Recusar projeto
  Route::get('/jobs-projetos/{projeto}/recusar', 'Freelancer\Job\JobController@recusarProjeto')->name('jobs.projeto.recusar');
  // Visualizar projeto
  Route::get('/job/{job}', 'Freelancer\Job\JobController@jobView')->name('job.view.freelancer');
  // Rotas grupos
  // Visualizar grupos
  Route::get('/grupos', 'Freelancer\Grupo\GrupoController@gruposView')->name('grupos.view');
  // Pesquisar por grupos
  Route::post('/grupos/pesquisar', 'Freelancer\Grupo\GrupoController@gruposPesquisar')->name('grupos.view.pesquisar');
  // Abrir formulário de cadastro de grupo
  Route::get('/grupos/add', 'Freelancer\Grupo\GrupoController@novoGrupo')->name('grupo.novo');
  // Submeter e criar novo grupo
  Route::post('/grupos/add', 'Freelancer\Grupo\GrupoController@criarGrupo')->name('grupo.criar');
  // View grupo
  Route::get('/grupo/{grupo}', 'Freelancer\Grupo\GrupoController@grupoView')->name('grupo.view');
  // Fechar grupo
  Route::get('/grupo/{grupo}/fechar', 'Freelancer\Grupo\GrupoController@fecharGrupo')->name('grupo.fechar');
  // Abrir formulário de edição de grupo
  Route::get('/grupo/{grupo}/editar', 'Freelancer\Grupo\GrupoController@editarGrupoView')->name('grupo.editar.view');
  // Submeter e editar o grupo
  Route::post('/grupo/editar', 'Freelancer\Grupo\GrupoController@editarGrupo')->name('grupo.editar');
  // Mostrar freelancers para convidar para o grupo
  Route::get('/grupo/{grupo}/integrante/novo', 'Freelancer\Grupo\GrupoController@novoFormIntegrantes')->name('grupo.add.integrantes.form');
  // Adicionar freelancer ao job
  Route::get('/grupo/{grupo}/integrante/{freelancer}/add', 'Freelancer\Grupo\GrupoController@addFreelancer')->name('grupo.add.integrante');
  // Remover freelancer do grupo
  Route::get('/grupo/{grupo}/integrante/{freelancer}/remover', 'Freelancer\Grupo\GrupoController@removerFreelancer')->name('grupo.remover-freelancer');
  // Aceitar projeto
  Route::get('/grupo/{grupo}/aceitar', 'Freelancer\Grupo\GrupoController@aceitarGrupo')->name('grupo.aceitar');
  // Recusar projeto
  Route::get('/grupo/{grupo}/recusar', 'Freelancer\Grupo\GrupoController@recusarGrupo')->name('grupo.recusar');
  // Rotas de portifólio
  Route::get('/portifolios', 'Freelancer\Portifolio\PortifolioController@portifoliosView')->name('portifolios.view');
  //
  Route::get('/portifolio/novo', 'Freelancer\Portifolio\PortifolioController@criarPortifolioView')->name('portifolio.novo');
  //
  Route::post('/portifolio/novo', 'Freelancer\Portifolio\PortifolioController@criarPortifolio')->name('portifolio.criar');
  // Excluir portifólio
  Route::get('/portifolio/{portifolio}/excluir', 'Freelancer\Portifolio\PortifolioController@excluirPortifolio')->name('portifolio.excluir');
  // Abrir formulário de editar portifólio
  Route::get('/portifolio/{portifolio}/editar', 'Freelancer\Portifolio\PortifolioController@editarPortifolioView')->name('portifolio.editar.view');
  // Editar portifólio
  Route::post('/portifolio/editar', 'Freelancer\Portifolio\PortifolioController@editarPortifolio')->name('portifolio.editar');
  // Ver rotas de pesquisa
  // Visualizar perfil de um freelancer
  Route::get('/pesquisa/perfil-freelancer/{freelancer}', 'Freelancer\Pesquisa\PesquisaController@viewPerfilFreelancer')->name('view.perfil-freelancer.freelancer');
  // Visualizar perfil/conhecimentos de um freelancer
  Route::get('/pesquisa/perfil-freelancer/conhecimentos/{freelancer}', 'Freelancer\Pesquisa\PesquisaController@viewConhecimentosFreelancer')->name('view.conhecimentos-freelancer.freelancer');
  // Visualizar portifolio de um freelancer
  Route::get('/pesquisa/perfil-freelancer/portifolios/{freelancer}', 'Freelancer\Pesquisa\PesquisaController@viewPortifoliosFreelancer')->name('view.portifolios-freelancer.freelancer');
});

// Auth::routes();