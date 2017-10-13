<!-- Page Container -->
<div id="" class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">Perfil Empresa</h4>
         <p class="w3-center"><img src="{{ asset('storage') . '/empresas/perfil/' . $empresa->foto_perfil }}" class="w3-circle" style="height:164px;width:164px" alt="Imagem da empresa"></p>
         <hr>
         <p title="Nome de usuário"><i class="fa fa-address-card-o fa-fw w3-margin-right w3-text-theme"></i> {{ $empresa->categoria . ": " . $empresa->nome }}</p>
         <p title="Cidade/Estado"><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> {{ $empresa->endereco->cidade . " - " . $empresa->endereco->uf}}</p>
         <p title="Data de cadastro"><i class="fa fa-calendar fa-fw w3-margin-right w3-text-theme"></i> {{ $empresa->created_at->format('d/m/Y') }}</p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card-2 w3-round">
        <div class="w3-white groups">          
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> Meus Projetos</button>
          <div id="Demo2" class="w3-hide w3-container">
            <form method="get" action="{{ route('projeto.show-form-novo') }}">
              <button type="input" class="geral">Criar Projeto</button>
            </form>
            <hr>
            <p><a href="{{ route('projetos.view') }}">Gerenciar projetos</a></p>
          </div>
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Avaliações</button>
          <div id="Demo1" class="w3-hide w3-container">
            <hr>
            <p><a href="">Minhas avaliações</a></p>
            <p><a href="">Avaliações recebidas</a></p>
          </div>
        </div>      
      </div>
      <br>
      
      <!-- Interests --> 
      <div class="w3-card-2 w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Tecnologias <span class="opt-tec">[<a href="{{ route('conhecimento.add') }}">Adicionar</a>][<a href="">Remover</a>]</span></p>
          <p>
            @foreach ($empresa->conhecimentos as $conhecimento)
              <span class="w3-tag w3-small w3-theme-d5">{{ $conhecimento->titulo }}</span>
            @endforeach
           {{--  <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
            <span class="w3-tag w3-small w3-theme-d3">Labels</span>
            <span class="w3-tag w3-small w3-theme-d2">Games</span>
            <span class="w3-tag w3-small w3-theme-d1">Friends</span>
            <span class="w3-tag w3-small w3-theme">Games</span>
            <span class="w3-tag w3-small w3-theme-l1">Friends</span>
            <span class="w3-tag w3-small w3-theme-l2">Food</span>
            <span class="w3-tag w3-small w3-theme-l3">Design</span>
            <span class="w3-tag w3-small w3-theme-l4">Art</span>
            <span class="w3-tag w3-small w3-theme-l5">Photos</span> --}}
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