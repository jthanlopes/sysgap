@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
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
                    <option value="3">Grupos</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nome">Usuário:</label>
                  <input type="text" class="w3-input" id="nome" placeholder="Digite nome, email ou título" name="nome">
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
                      <div class="form-group" style="margin-top: 30px;">
                        <label for="categoria">Cidades:</label> <br/>
                        @foreach ( $cidades as $cidade)
                        <input class="w3-check" type="checkbox" name="cidades[]" value="{{ $cidade->cidade }}">
                        <label style="font-weight: normal; margin-right: 10px;">{{ $cidade->cidade }}</label>
                        @endforeach
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="nome">Tecnologias:</label> <br/>
                        @foreach ( $tecnologias as $tecnologia)
                        <input class="w3-check" type="checkbox" name="tecnologias[]" value={{ $tecnologia->titulo }}>
                        <label style="font-weight: normal; margin-right: 10px;">{{ $tecnologia->titulo }}/{{ $tecnologia->descricao }}</label>
                        @endforeach
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
              <td><a href="/empresa/pesquisa/perfil-freelancer/{{ $freelancer->id }}" class="w3-button w3-blue w3-small" title="Ver perfil do freelancer">Ver perfil</a>
              </td>
            </tr>
            @endforeach
            @foreach ( $produtoras as $produtora)
            <tr>
              <td>{{ $produtora->nome }}</td>
              <td>{{ $produtora->email }}</td>
              <td><a href="/empresa/pesquisa/perfil-produtora/{{ $produtora->id }}" class="w3-button w3-blue w3-small" title="Ver perfil da produtora">Ver perfil</a>
              </td>
            </tr>
            @endforeach
            @foreach ( $grupos as $grupo)
            <tr>
              <td>{{ $grupo->titulo }}</td>
              <td>{{ $grupo->freelancer->email }}</td>
              <td><a href="/empresa/pesquisa/perfil-produtora/{{ $produtora->id }}" class="w3-button w3-blue w3-small" title="Ver perfil da produtora">Ver grupo</a>
              </td>
            </tr>
            @endforeach
          </table>
          @if(count($freelancers) == 0 && count($produtoras) == 0)
          <div style="text-align: center; margin-top: 10px;">
            Nenhum resultado para a pesquisa.
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection