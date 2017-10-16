@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">{{ $projeto->titulo }}</h3>
          <p class="w3-opacity">Descrição: {{ $projeto->descricao }}</p>
          <p class="w3-opacity">Data de criação: {{ $projeto->created_at->format('d/m/Y') }}</p>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <h4 class="w3-opacity">Gerenciar Equipe</h4>
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection