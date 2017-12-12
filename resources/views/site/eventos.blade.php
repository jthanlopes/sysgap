@extends ('site.layouts.home.master')

@section ('conteudo')
<div class="w3-row-padding w3-padding-64 w3-container eventos">
  <div class="w3-content">
    <h1>Eventos / Notícias</h1>
    <hr>
    @foreach ($noticias as $noticia)
    <div class="w3-panel w3-card">
      <div class="noticia-img" style="width: 40%; float: left;">
        {{-- <img src="{{ $noticia->imagem }}" alt="Imagem notícia"> --}}
        <img src="{{ asset('storage') . '/admins/noticias/' . $noticia->imagem }}" alt="Imagem Notícia" style="width: 100%; height: 96%;">
      </div>
      <div class="noticia-text" style="width: 50%; float: right;">
        <div style="height: 79%;">
          <h2>{{ $noticia->titulo }}</h2>
          <p>{{ substr($noticia->conteudo, 0, 300)."..." }}</p>
        </div>

        <div>
          <p style="float: right; padding-top: 14px;">{{ $noticia->created_at->format('d/m/Y') }}</p>
          <a class="btn-veja-mais" href="/eventos/evento-view/{{ $noticia->id }}"><span>Veja mais </span></a>
        </div>
      </div>
    </div>
    @endforeach
    <div class="paginacao">
      {{ $noticias->links() }}
    </div>
  </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $( "#home, #contato" ).removeClass( "w3-white" );
    $( "#eventos" ).addClass( "w3-white" );
  });
</script>