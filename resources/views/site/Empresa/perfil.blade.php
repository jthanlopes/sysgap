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
            <form method="POST" action="">
              <p><input type="text" placeholder="Título da publicação"></p>
              <p><textarea name="" id="" cols="30" rows="10" placeholder="Conteúdo da publicação"></textarea></p>
              <label for="">Imagem do post:</label>
              <p><input type="file"></p>
              <button type="input" class="w3-button w3-theme"><i class="fa fa-pencil"></i> &nbsp;Postar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
    <img src="/w3images/avatar2.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
    <span class="w3-right w3-opacity">1 min</span>
    <h4>John Doe</h4><br>
    <hr class="w3-clear">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-half">
        <img src="/w3images/lights.jpg" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
      </div>
      <div class="w3-half">
        <img src="/w3images/nature.jpg" style="width:100%" alt="Nature" class="w3-margin-bottom">
      </div>
    </div>
    <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i> &nbsp;Like</button> 
    <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button> 
  </div>

  <!-- End Middle Column -->
</div>      
@endsection