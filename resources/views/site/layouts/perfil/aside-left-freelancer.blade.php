<?php
use App\Freelancer;

$freelancer = Freelancer::find(auth()->user()->id);
$total = $freelancer->pontuacoes->sum('valor');
$freelancer->pontuacao = $total;
$freelancer->save();

?>

<!-- Page Container -->
<div id="" class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><a href="{{ route('freelancer.perfil') }}">Perfil Freelancer</a></h4>
         <p class="w3-center"><img src="{{ asset('storage') . '/freelancers/perfil/' . $freelancer->foto_perfil }}" class="w3-circle" style="height:130px;width:130px" alt="Imagem da freelancer"></p>
         <hr>
         <div style="text-align: center;">
           <p title="Nome de usuário">{{ $freelancer->nome }}</p>
           <p title="E-mail">{{ $freelancer->email }}</p>
           <p title="Data de cadastro">{{ $freelancer->created_at->format('d/m/Y') }}</p>
           <hr>
           <p> Pontuação: {{ $freelancer->pontuacao }} pontos</p>
           <p> Avaliação: {{ number_format($freelancer->avaliacao_geral, 2, '.', '') }}/5 <i class="fa fa-star" aria-hidden="true" style="color: #daa520;"></i></p>
         </div>
       </div>
     </div>
     <br>

     <!-- Accordion -->
     <div class="w3-card-2 w3-round">
      <div class="w3-white groups">
        <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Meus Grupos</button>
        <div id="Demo1" class="w3-hide w3-container">
          <form method="get" action="{{ route('grupo.novo') }}">
            <button type="input" class="geral">Criar Grupo</button>
          </form>
          <hr>
          <p><a href="{{ route('grupos.view') }}">Gerenciar grupos</a></p>
        </div>
        <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> Meus Jobs</button>
        <div id="Demo2" class="w3-hide w3-container">
          <hr>
          <p><a href="{{ route('jobs.view.freelancer') }}">Visualizar todos</a></p>
          <p><a href="{{ route('jobs.projeto.view') }}">Filtrar por projeto</a></p>
        </div>
        <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Portfólio</button>
        <div id="Demo3" class="w3-hide w3-container">
         <hr>
         <p><a href="{{ route('portifolios.view') }}">Gerenciar portfólio</a></p>
       </div>
     </div>
   </div>
   <br>

   <!-- Interests -->
   <div class="w3-card-2 w3-round w3-white w3-hide-small">
    <div class="w3-container">
      <p>Conhecimentos <span class="opt-tec">[<a href="{{ route('tecnologias.view.freelancer') }}">Gerenciar Conhecimentos</a>]</span></p>
      <p>
        @foreach ($freelancer->conhecimentos as $conhecimento)
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