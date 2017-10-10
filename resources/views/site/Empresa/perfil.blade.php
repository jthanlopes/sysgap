@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding form-news">
          <div class="publicar-empresa"> 
            <h6 class="w3-opacity" style="cursor: pointer;">Publique aqui notícias e/ou eventos.</h6>      
          </div>
          <div class="form-publicar">
            <form method="POST" action="{{ route('noticia.novo') }}">
              {{ csrf_field() }}
              <p><input type="text" name="titulo" placeholder="Título da publicação"></p>
              <p><textarea name="conteudo" id="" cols="30" rows="10" placeholder="Conteúdo da publicação"></textarea></p>
              <label for="">Imagem do post:</label>
              <p><input type="file"></p>
              <button type="input" name="imagem_noticia" class="w3-button w3-theme"><i class="fa fa-pencil"></i> &nbsp;Postar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  @foreach($noticias as $noticia)
  <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
    <span class="w3-right w3-opacity">{{ $noticia->created_at->format('d/m/Y') }} {{-- 1 min --}}</span>
    <h4>{{ $noticia->titulo }}</h4><br>
    <hr class="w3-clear">
    <p>{{ $noticia->conteudo }}</p>
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-half">
        <img src="/w3images/lights.jpg" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
      </div>      
    </div>    
  </div>
  @endforeach

  <!-- End Middle Column -->
</div>      
@endsection