@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Meu Portifólio <span class="opt-post">[<a href="{{ route('portifolio.novo.empresa') }}">Novo</a>]</span></h3>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          @foreach ($portifolios as $portifolio)
          <div class="w3-card-4" style="width:100%; margin-bottom: 30px;">
            <a href="{{ $portifolio->link }}" target="_blank"><img src="{{ asset('storage')  . '/empresas/portifolio/' . Auth::user()->id . '/' . $portifolio->imagem  }}" alt="Norway" style="width:100%; height: 200px;"></a>
            <div class="w3-container w3-center">
              <hr>
              <p style="font-weight: bold;">{{ $portifolio->titulo }} <span style="float: right; font-weight: normal;"> [<a href="/empresa/portifolio/{{ $portifolio->id }}/editar">Editar</a>][<a href="/empresa/portifolio/{{ $portifolio->id }}/excluir">Excluir</a>]</span></p>
            </div>
          </div>
          @endforeach
          @if(count($portifolios) == 0)
          <div style="text-align: center; margin-top: 10px;">
            Você não tem nenhum portifólio cadastrado.
          </div>
          @endif
          <div style="text-align: center;">
            {{ $portifolios->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection