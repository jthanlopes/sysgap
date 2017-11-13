@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      @if(session()->has('message'))
      <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session()->get('message')['message'] }}
      </div>
      @endif
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding form-news">
          <div class="publicar-empresa">
            <h6 class="w3-opacity" style="cursor: pointer;">Publique aqui notícias e/ou eventos.</h6>
          </div>
          <hr>
          <div class="form-publicar">
            <form method="POST" action="{{ route('noticia.novo') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="titulo">Título da publicação:</label>
                    <input type="text" class="w3-input" id="titulo" placeholder="Digite o título" name="titulo">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="descricao">Conteúdo da publicação:</label>
                    <textarea class="w3-input w3-border" name="conteudo" id="" cols="20" rows="5" placeholder="Digite a descrição"></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="imagem">Imagem do post:</label>
                    <input type="file" name="imagem">
                  </div>
                </div>
              </div>
              <button type="input" name="postar" class="w3-button w3-theme"><i class="fa fa-pencil"></i> &nbsp;Postar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  @foreach($noticias as $noticia)
  <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
    <span class="w3-right w3-opacity">{{ $noticia->created_at->diffForHumans() }} {{-- 1 min --}}</span>
    <h4>{{ $noticia->titulo }} <span class="opt-post">[<a href="">Editar</a>][<a href="/empresa/noticia/excluir/{{ $noticia->id }}">Excluir</a>]</span></h4><br>
    <hr class="w3-clear">
    <p>{{ $noticia->conteudo }}</p>
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-half">
        <img src="{{ asset('storage')  . '/empresas/posts/' . Auth::user()->id . '/' . $noticia->imagem  }}" style="width:100%" alt="Imagem do Post" class="w3-margin-bottom">
      </div>
    </div>
  </div>
  @endforeach

  <!-- End Middle Column -->
</div>
@endsection