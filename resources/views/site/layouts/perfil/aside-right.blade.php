<?php

use App\Empresa;
use App\Freelancer;

$empresasRanking = Empresa::where('categoria', 'Agência')->orderBy('pontuacao', 'DESC')->limit(3)->get();

$produtorasRanking = Empresa::where('categoria', 'Produtora')->orderBy('pontuacao', 'DESC')->limit(3)->get();

$freelancersRanking = Freelancer::orderBy('pontuacao', 'DESC')->limit(3)->get();

?>

<!-- Right Column -->
<div class="w3-col m2">
  <div class="w3-card-2 w3-round w3-white w3-center">
    <p class="w3-block w3-theme-l1 w3-left-align" style="padding: 10px; margin-bottom: 0">Ranking Agências</p>
    <table class="w3-table w3-striped w3-centered">
      <tr>
        <th>Agência</th>
        <th>Pontuação</th>
      </tr>
      @foreach($empresasRanking as $empresaR)
      <tr>
        <td><a href="/empresa/pesquisa/perfil-produtora/{{ $empresaR->id }}" title="Ver perfil" target="_blank">{{ $empresaR->nome }}</a></td>
        <td>{{ $empresaR->pontuacao }}pts</td>
      </tr>
      @endforeach
    </table>
  </div>
  <br>

  <div class="w3-card-2 w3-round w3-white w3-center">
    <p class="w3-block w3-theme-l1 w3-left-align" style="padding: 10px; margin-bottom: 0">Ranking Produtoras</p>
    <table class="w3-table w3-striped w3-centered">
      <tr>
        <th>Produtora</th>
        <th>Pontuação</th>
      </tr>
      @foreach($produtorasRanking as $produtoraR)
      <tr>
        <td><a href="/empresa/pesquisa/perfil-produtora/{{ $produtoraR->id }}" title="Ver perfil" target="_blank">{{ $produtoraR->nome }}</a></td>
        <td>{{ $produtoraR->pontuacao }}pts</td>
      </tr>
      @endforeach
    </table>
  </div>
  <br>

  <div class="w3-card-2 w3-round w3-white w3-center">
    <p class="w3-block w3-theme-l1 w3-left-align" style="padding: 10px; margin-bottom: 0">Ranking Freelancers</p>
    <table class="w3-table w3-striped w3-centered">
      <tr>
        <th>Freelancer</th>
        <th>Pontuação</th>
      </tr>
      @foreach($freelancersRanking as $freelancerR)
      <tr>
        <td><a href="/empresa/pesquisa/perfil-freelancer/{{ $freelancerR->id }}" title="Ver perfil" target="_blank">{{ $freelancerR->nome }}</a></td>
        <td>{{ $freelancerR->pontuacao }}pts</td>
      </tr>
      @endforeach
    </table>
  </div>
  <br>

  <!-- End Right Column -->
</div>

<!-- End Grid -->
</div>

<!-- End Page Container -->
</div>
<br>