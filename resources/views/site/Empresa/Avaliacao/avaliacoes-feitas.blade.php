<?php use App\Freelancer; ?>
@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Avaliações Feitas</h3>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <h4 class="w3-opacity">Freelancers avaliados</h4>
          @foreach($avaliacoesFreelas as $avaliFreela)
          <?php $freelancerAvaliado = Freelancer::find($avaliFreela->freelancer_avaliado) ?>
          <p>Nome: {{ $freelancerAvaliado->nome }}</p>
          <p>Nome: {{ $freelancerAvaliado->item->pergunta }}</p>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection