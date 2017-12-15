@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Finalizar projeto {{ $projeto->titulo }}</h3>
          <h6 class="animate-bounce">Avalie todos os freelancers e produtoras para poder finalizar o projeto!</h6>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable" style="margin-top: 10px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <form method="POST" action="{{ route('projetos.view.pesquisar') }}">
            {{ csrf_field() }}
          </form>
          @foreach($freelancers as $freelancer)
          @foreach ($freelancer->projetos as $projetoFreela)
          @if($projetoFreela->id == $projeto->id && $projetoFreela->pivot->aceito == 1)
          <h4 class="w3-opacity">Freelancers no projeto</h4>
          <hr>
          <div>
            <div style="float: left; margin-left: 20px;">
              <img src="{{ asset('storage') . '/freelancers/perfil/' . $freelancer->foto_perfil }}"" alt="Foto do usuário" style="width: 120px;">
            </div>
            <div style="float: left; margin-left: 10px;">
              <p>{{ $freelancer->nome }}</p>
              <p>{{ $freelancer->email }}</p>
              @if($projetoFreela->pivot->avaliado == 0)
              <a href="/empresa/projeto/{{ $projeto->id }}/finalizar/avaliar/{{ $freelancer->id }}" class="w3-button w3-blue w3-small" title="Avaliar freelancer">Avaliar</a>
              @else
              <u>Usuário já avaliado!</u>
              @endif
            </div>
          </div>
          @endif
          @endforeach
          @endforeach
          <div style="clear: both;"><br><br><br></div>
          @foreach($produtoras as $produtora)
          @foreach ($produtora->projetos as $projetoProd)
          @if($projetoProd->id == $projeto->id && $projetoProd->pivot->aceito == 1)
          <div style="clear: both; margin-top: 0; margin-bottom: 30px;">
           <h4 class="w3-opacity">Produtoras no projeto</h4>
           <hr>
           <div style="float: left; margin-left: 20px;">
            <img src="{{ asset('storage') . '/empresas/perfil/' . $produtora->foto_perfil }}"" alt="Foto do usuário" style="width: 120px; height: 120px;">
          </div>
          <div style="float: left; margin-left: 10px;">
            <p>{{ $produtora->nome }}</p>
            <p>{{ $produtora->email }}</p>
            @if($projetoProd->pivot->avaliado == 0)
            <a href="/empresa/projeto/{{ $projeto->id }}/finalizar/avaliar-produtora/{{ $produtora->id }}" class="w3-button w3-blue w3-small" title="Avaliar produtora">Avaliar</a>
            @else
            <u>Usuário já avaliado!</u>
            @endif
          </div>
        </div>
        @endif
        @endforeach
        @endforeach
        @if(count($freelancers) == 0 && count($produtoras) == 0)
        <div style="text-align: center; margin-top: 10px;">
          Para finalizar o projeto, primeiro crie jobs e adicione integrantes.
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
<!-- End Middle Column -->
</div>
@endsection