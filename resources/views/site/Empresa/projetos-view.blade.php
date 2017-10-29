@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Meus Projetos <span class="opt-post">[<a href="{{ route('projeto.show-form-novo') }}">Criar projeto</a>]</span></h3>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <form method="POST" action="{{ route('projetos.view.pesquisar') }}">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <input class="w3-input w3-border" type="text" name="buscar" placeholder="Buscar projeto">
              </div>
              <div class="col-md-6">
                <button type="input">Buscar</button>
              </div>
            </div>            
          </form>
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Título</th>
              <th>Ações</th>
            </tr>
            @foreach ($projetos as $projeto)
            <tr>
              <td>{{ $projeto->titulo }}</td>
              <td><a href="/empresa/projeto/{{ $projeto->id }}" class="w3-button w3-blue w3-small" title="Visualizar e editar o projeto">Visualizar</a>
                <button class="w3-button w3-red w3-small" title="Finalizar o projeto">Finalizar</button></td>
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