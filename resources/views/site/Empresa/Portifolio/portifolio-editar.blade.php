@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding form-news">
          <h3 class="w3-opacity">Editar Portfólio</h3>
          <hr>
          <form method="POST" action="{{ route('portifolio.editar.empresa') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="portifolio" value="{{ $portifolio->id }}">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="titulo">Título do portfólio:</label>
                  <input type="text" class="w3-input" id="titulo" placeholder="Digite o título" name="titulo" value="{{ $portifolio->titulo}}" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="link">Link:</label>
                  <input type="text" class="w3-input" id="link" placeholder="Digite o link" name="link" value="{{ $portifolio->link }}" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="imagem">Imagem:</label>
                  <input type="file" name="imagem">
                </div>
              </div>
            </div>
            <hr>
            <input type="submit" value="Editar">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection