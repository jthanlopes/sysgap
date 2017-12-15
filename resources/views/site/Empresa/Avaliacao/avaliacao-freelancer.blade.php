@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Avaliar {{ $freelancer->nome }}</h3>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <form method="POST" action="/empresa/projeto/{{ $projeto->id }}/finalizar/avaliar/{{ $freelancer->id }}">
            {{ csrf_field() }}

            <input type="hidden" value="{{ $freelancer->id }}" name="idFreelancer">
            <input type="hidden" value="{{ $projeto->id }}" name="idProjeto">
            @foreach($items as $item)
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="titulo">{{ $item->pergunta }}:</label>
                  <select class="w3-select" name="item-{{ $item->id }}" required>
                    <option value="" disabled selected>Escolha a nota</option>
                    <option value="1">1 estrela</option>
                    <option value="2">2 estrelas</option>
                    <option value="3">3 estrelas</option>
                    <option value="4">4 estrelas</option>
                    <option value="5">5 estrelas</option>
                  </select>
                </div>
              </div>
            </div>
            @endforeach
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="titulo">Avaliação descritiva (opcional):</label>
                  <textarea class="w3-input w3-border" name="descritiva" cols="20" rows="5" placeholder="Você recomendaria este freelancer? (opcional)" style="max-width: 100%; min-width: 100%;"></textarea>
                </div>
              </div>
            </div>
            <hr>
            <input type="submit" class="w3-button w3-green w3-small" title="Finalizar avaliação" value="Avaliar">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection