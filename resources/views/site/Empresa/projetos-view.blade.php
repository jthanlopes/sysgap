@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Meus Projetos <span class="opt-post">[<a href="{{ route('projeto.show-form-novo') }}">Criar projeto</a>]</span></h3>
          Projetos: <span> abertos ({{ count($projetosAbertos) }}), </span><span> cancelados ({{ count($projetosCancelados) }}), </span><span> finalizados ({{ count($projetosFinalizados) }})</span>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable" style="margin-top: 10px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <form method="POST" action="{{ route('projetos.view.pesquisar') }}">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input class="w3-input w3-border" type="text" name="buscar" placeholder="Buscar projeto">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <button type="input">Buscar</button>
                </div>
              </div>
            </div>
          </form>
          <hr>
          <h4 class="w3-opacity">Projetos em aberto</h4>
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Título</th>
              <th>Data Criação</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
            @foreach ($projetosAbertos as $projeto)
            <tr>
              <td>{{ $projeto->titulo }}</td>
              <td>{{ $projeto->created_at->format('d-m-Y') }}</td>
              <td>{{ $projeto->status }}</td>
              <td>
                <a href="/empresa/projeto/{{ $projeto->id }}" class="w3-button w3-blue w3-small" title="Visualizar e editar o projeto">Visualizar</a>
                <a href="/empresa/projeto/{{ $projeto->id }}/finalizar" class="w3-button w3-green w3-small" title="Finalizar o projeto">Finalizar</a>
                <a href="/empresa/projeto/{{ $projeto->id }}/cancelar" class="w3-button w3-red w3-small" title="Cancelar o projeto">Cancelar</a>
              </td>
            </tr>
            @endforeach
          </table>
          @if(count($projetosAbertos) == 0)
          <div style="text-align: center; margin-top: 10px;">
            Nenhum projeto em aberto.
          </div>
          @endif
          <hr>
          <h4 class="w3-opacity">Projetos finalizados</h4>
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Título</th>
              <th>Data Criação</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
            @foreach ($projetosFinalizados as $projeto)
            <tr>
              <td>{{ $projeto->titulo }}</td>
              <td>{{ $projeto->created_at->format('d-m-Y') }}</td>
              <td>{{ $projeto->status }}</td>
              <td>
                <a href="/empresa/projeto/{{ $projeto->id }}" class="w3-button w3-blue w3-small" title="Visualizar e editar o projeto">Visualizar</a>
              </td>
            </tr>
            @endforeach
          </table>
          @if(count($projetosFinalizados) == 0)
          <div style="text-align: center; margin-top: 10px;">
            Nenhum projeto foi finalizado.
          </div>
          @endif
          <hr>
          <h4 class="w3-opacity">Projetos cancelados</h4>
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Título</th>
              <th>Data Criação</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
            @foreach ($projetosCancelados as $projeto)
            <tr>
              <td>{{ $projeto->titulo }}</td>
              <td>{{ $projeto->created_at->format('d-m-Y') }}</td>
              <td>{{ $projeto->status }}</td>
              <td>
                <a href="/empresa/projeto/{{ $projeto->id }}" class="w3-button w3-blue w3-small" title="Visualizar o projeto">Visualizar</a>
                <a href="/empresa/projeto/{{ $projeto->id }}/reabrir" class="w3-button w3-red w3-small" title="Reabrir o projeto">Reabrir</a>
              </td>
            </tr>
            @endforeach
          </table>
          @if(count($projetosCancelados) == 0)
          <div style="text-align: center; margin-top: 10px;">
            Nenhum projeto foi cancelado.
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection