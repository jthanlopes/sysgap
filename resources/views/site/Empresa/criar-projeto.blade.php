@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding form-news">
          <h3 class="w3-opacity">Cadastro de Projeto</h3>          
          <hr>
          <form method="POST" action="{{ route('projeto.novo') }}">
            {{ csrf_field() }}
            <label for="titulo">Título do projeto:</label>
            <input type="text" name="titulo" placeholder="Digite o título">
            <label for="descricao">Descrição do projeto:</label>
            <textarea name="descricao" id="" cols="30" rows="10" placeholder="Digite a descrição"></textarea>
            <hr>
            <input type="submit" value="Cadastrar">
          </form>   
        </div>
      </div>
    </div>
  </div>

  
  <!-- End Middle Column -->
</div>      
@endsection