@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding form-news">
          <h3 class="w3-opacity">Adicionar integrante ao grupo</h3>
          <hr>
          <form method="POST" action="/freelancer/grupo/{{ $grupo->id }}/integrante/pesquisar">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nome">Pesquisar por usuário:</label>
                  <input type="text" class="w3-input" id="nome" placeholder="Digite o nome ou e-mail" name="nome">
                </div>
              </div>
            </div>
            <hr>
            <input type="submit" value="Pesquisar">
          </form>
          <h4 class="w3-opacity" style="margin-top: 40px;">Listagem de freelancers</h4>
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Ações</th>
            </tr>
            @foreach ($results as $result)
            <tr>
              <td><a href="" title="Ver perfil">{{ $result->nome }}</a></td>
              <td>{{ $result->email }}</td>
              <td>
                <a href="/freelancer/grupo/{{ $grupo->id }}/integrante/{{ $result->id }}/add" class="w3-button w3-blue w3-small" title="Adicionar integrante">Convidar</a></td>
              </tr>
              @endforeach
            </table>
            @if(count($results) == 0)
            <div style="text-align: center; margin-top: 10px;">
              Nenhum freelancer encontrado.
            </div>
            @endif
            <div style="text-align: center">
              {{ $results->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- End Middle Column -->
  </div>
  @endsection