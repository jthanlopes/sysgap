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
                    <option value="3">Agências</option>
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
                        <select class="js-example-basic-multiple" name="cidades[]" multiple="multiple" style="width: 100%;">
                          @foreach ( $cidades as $cidade)
                          <option value="{{ $cidade->cidade }}">{{ $cidade->cidade }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="nome">Tecnologias:</label> <br/>
                        <select class="js-example-basic-multiple" name="tecnologias[]" multiple="multiple" style="width: 100%;">
                          @foreach ( $tecnologias as $tecnologia)
                          <option value="{{ $tecnologia->titulo }}">{{ $tecnologia->titulo }}</option>
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
          <h4 class="w3-opacity" style="margin-top: 40px;">Listagem de {{ $tipo }}</h4>
          <div class="table-scroll">
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
              @foreach ( $agencias as $agencia)
              <tr>
                <td>{{ $agencia->nome }}</td>
                <td>{{ $agencia->email }}</td>
                @if($agencia->id == $empresa->id)
                <td><a href="{{ route('empresa.perfil') }}" class="w3-button w3-blue w3-small" title="Ver perfil da agência">Meu perfil</a>
                </td>
                @else
                <td><a href="/empresa/pesquisa/perfil-produtora/{{ $agencia->id }}" class="w3-button w3-blue w3-small" title="Ver perfil da agência">Ver perfil</a>
                </td>
                @endif
              </tr>
              @endforeach
            </table>
          </div>
          @if(count($freelancers) == 0 && count($produtoras) == 0 && count($agencias) == 0)
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