@extends ('site.layouts.home.master')

@section ('conteudo')
<div class="w3-row-padding w3-padding-64 w3-container eventos">
  <div class="acessibilidade">
    <p><strong>Fonte: </strong></p>
    <img id="diminuir-fonte" src="/site-assets/img/home/diminuirFonte.png" alt="Icone de lupa para diminuir a fonte." title="Diminuir fonte da página.">
    <img id="aumentar-fonte" src="/site-assets/img/home/aumentarFonte.png" alt="Icone de lupa para aumentar a fonte." title="Aumentar fonte da página.">
  </div>
  <div class="w3-content">
    <h1>{{ $noticia->titulo }}</h1>
    <hr>
    <p>{{ $noticia->conteudo }}</p>    
    <img src="{{ $noticia->imagem }}" alt="Imagem notícia">
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