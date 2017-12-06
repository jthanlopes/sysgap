@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Finalizar projeto {{ $projeto->titulo }}</h3>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <form method="POST" action="{{ route('projetos.view.pesquisar') }}">
            {{ csrf_field() }}
          </form>
          @foreach($freelancers as $freelancer)
          <div>
            <div style="float: left; margin-left: 20px;">
              <img src="{{ asset('storage') . '/freelancers/perfil/' . $freelancer->foto_perfil }}"" alt="Foto do usuário" style="width: 120px;">
            </div>
            <div style="float: left; margin-left: 10px;">
              <p>{{ $freelancer->nome }}</p>
              <p>{{ $freelancer->email }}</p>
              @if($freelancer->pivot->avaliado == 0)
              <a href="" class="w3-button w3-blue w3-small" title="Avaliar usuário">Avaliar</a>
              @else
              Usuário já avaliado!
              @endif
            </div>
          </div>
          @endforeach

          @foreach($produtoras as $produtora)
          <div style="clear: both; margin-top: 180px; margin-bottom: 30px;">
            <div style="float: left; margin-left: 20px;">
              <img src="{{ asset('storage') . '/empresas/perfil/' . $produtora->foto_perfil }}"" alt="Foto do usuário" style="width: 120px; height: 120px;">
            </div>
            <div style="float: left; margin-left: 10px;">
              <p>{{ $produtora->nome }}</p>
              <p>{{ $produtora->email }}</p>
              @if($produtora->pivot->avaliado == 0)
              <a href="" class="w3-button w3-blue w3-small" title="Avaliar usuário">Avaliar</a>
              @else
              Usuário já avaliado!
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection