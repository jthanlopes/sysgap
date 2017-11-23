<!-- Page Container -->
<div id="" class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><a href="{{ route('empresa.perfil') }}">Perfil Empresa</a></h4>
         <p class="w3-center"><img src="{{ asset('storage') . '/empresas/perfil/' . $empresa->foto_perfil }}" class="w3-circle" style="height:130px;width:130px" alt="Imagem da empresa"></p>
         <hr>
         <div style="text-align: center;">
           <p title="Nome de usuário">{{ $empresa->categoria . ": " . $empresa->nome }}</p>
           <p title="E-mail">{{ $empresa->email }}</p>
           <p title="Cidade/Estado">{{ $empresa->endereco->cidade . " - " . $empresa->endereco->uf}}</p>
           <p title="Data de cadastro">{{ $empresa->created_at->format('d/m/Y') }}</p>
         </div>
       </div>
     </div>
     <br>

     <!-- Accordion -->
     <div class="w3-card-2 w3-round">
      <div class="w3-white groups">
        <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-book fa-fw w3-margin-right"></i> Meus Projetos</button>
        <div id="Demo2" class="w3-hide w3-container">
          <form method="get" action="{{ route('projeto.show-form-novo') }}">
            <button type="input" class="geral">Criar Projeto</button>
          </form>
          <hr>
          <p><a href="{{ route('projetos.view') }}">Gerenciar projetos</a></p>
        </div>
        @if(auth()->user()->categoria == "Produtora")
        <button onclick="myFunction('Demo4')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> Meus Jobs</button>
        <div id="Demo4" class="w3-hide w3-container">
          <hr>
          <p><a href="{{ route('jobs.view.produtora') }}">Visualizar todos</a></p>
          <p><a href="{{ route('jobs-projeto.view.produtora') }}">Filtrar por projeto</a></p>
        </div>
        @endif
        <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-star fa-fw w3-margin-right"></i> Avaliações</button>
        <div id="Demo1" class="w3-hide w3-container">
          <hr>
          <p><a href="">Minhas avaliações</a></p>
          <p><a href="">Avaliações recebidas</a></p>
        </div>
        <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Portifólio</button>
        <div id="Demo3" class="w3-hide w3-container">
         <hr>
         <p><a href="{{ route('portifolios.view.empresa') }}">Gerenciar portifólio</a></p>
       </div>
     </div>
   </div>
   <br>

   <!-- Interests -->
   <div class="w3-card-2 w3-round w3-white w3-hide-small">
    <div class="w3-container">
      <p>Conhecimentos <span class="opt-tec">[<a href="{{ route('tecnologias.view') }}">Gerenciar Conhecimentos</a>]</span></p>
      <p>
        @foreach ($empresa->conhecimentos as $conhecimento)
        <span class="w3-tag w3-small w3-theme-l{{ rand(1, 5) }}">{{ $conhecimento->titulo }}</span>
        @endforeach
      </p>
    </div>
  </div>
  <br>

  <!-- Alert Box -->
  <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
    <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
      <i class="fa fa-remove"></i>
    </span>
    <p><strong>Alertas e Dicas!</strong></p>
    <p>Alertas e dicas para o usuário!</p>
  </div>

  <!-- End Left Column -->
</div>