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
          <form method="POST" action="{{ route('pesquisa.usuarios') }}">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="categoria">Tipo de usuário:</label>
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
                  <label for="nome">Usuário:</label>
                  <input type="text" class="w3-input" id="nome" placeholder="Digite nome ou email" name="nome">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="opcoes-pesquisa">
                  <h6 class="w3-opacity" style="cursor: pointer; text-decoration: underline;">Filtros de pesquisa</h6>
                </div>
                <div class="show-opcoes-pesquisa" style="display: none;">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="categoria">Cidade:</label>
                        <select class="w3-select" id="cidade" name="cidade" required>
                          <option value="">Todas</option>
                          @foreach ( $cidades as $cidade)
                          <option value="{{ $cidade->cidade }}">{{ $cidade->cidade }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <input type="submit" value="Pesquisar">
          </form>
          <h4 class="w3-opacity" style="margin-top: 40px;">Listagem de usuários</h4>
          <table class="w3-table w3-centered w3-bordered">
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Ações</th>
            </tr>
            @foreach ( $freelancers as $freelancer)
            <tr>
              <td>{{ $freelancer->nome }}</td>
              <td>{{ $freelancer->email }}</td>
              <td><a href="" class="w3-button w3-blue w3-small" title="Enviar e-mail para o freelancer">Ver perfil</a>
              </td>
            </tr>
            @endforeach
            @foreach ( $produtoras as $produtora)
            <tr>
              <td>{{ $produtora->nome }}</td>
              <td>{{ $produtora->email }}</td>
              <td><a href="" class="w3-button w3-blue w3-small" title="Enviar e-mail para o freelancer">Ver perfil</a>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection