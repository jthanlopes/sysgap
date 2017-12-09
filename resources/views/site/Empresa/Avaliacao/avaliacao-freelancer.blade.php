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
          <form method="POST">
            <input type="hidden" value="{{ $freelancer->id }}" name="idFreelancer">
            {{ csrf_field() }}
            @foreach($items as $item)
            <p>{{ $item->pergunta }}</p>
            <div class="quest ratestar">
              <select name="" id=""></select>
            </div>
            @endforeach
            <a href="" class="w3-button w3-green w3-small" title="Finalizar avaliação">Avaliar</a>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection