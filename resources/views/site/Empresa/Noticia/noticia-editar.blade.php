@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding form-news">
          <h3 class="w3-opacity">Editar Notícia</h3>
          <hr>
          <form method="POST" action="{{ route('noticia.editar') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $noticia->id }}" name="noticiaId">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="titulo">Título da publicação:</label>
                  <input type="text" class="w3-input" id="titulo" placeholder="Digite o título" name="titulo" value="{{ $noticia->titulo }}" required onfocus>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="descricao">Conteúdo da publicação:</label>
                  <textarea class="w3-input w3-border" name="conteudo" id="" cols="20" rows="5" placeholder="Digite a descrição" required>{{ $noticia->conteudo }}</textarea>
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
            <button type="input" name="postar" class="w3-button w3-theme"><i class="fa fa-pencil"></i> &nbsp;Editar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection