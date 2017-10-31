@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding form-news">
          <h3 class="w3-opacity">Pesquisar perfil de usuário</h3>
          <hr>
          <form method="POST" action="">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="categoria">Selecione o tipo de usuário:</label>
                  <select class="w3-select" id="categoria" name="categoria" required>
                    <option value="0">Todos</option>
                    <option value="1">Freelancers</option>
                    <option value="2">Produtoras</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nome">Pesquisar usuário</label>
                  <input type="text" class="w3-input" id="nome" placeholder="Digite nome ou email" name="nome">
                </div>
              </div>
            </div>
            <div class="w3-card-2 w3-round w3-white">
              <div class="w3-container w3-padding form-news">
                <div class="publicar-empresa">
                  <h6 class="w3-opacity" style="cursor: pointer;">Ver mais filtros de pesquisa.</h6>
                </div>
                <div>
                  <input type="text" placeholder="Cidade">
                </div>
                <hr>
              </div>
            </div>
            <hr>
            <input type="submit" value="Pesquisar">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection