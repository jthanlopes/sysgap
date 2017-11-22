@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      @if(session()->has('message'))
      <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session()->get('message')['message'] }}
      </div>
      @endif
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Meus Grupos <span class="opt-post">[<a href="{{ route('grupo.novo') }}">Criar grupo</a>]</span></h3>
          <hr>
          <form method="POST" action="{{ route('grupos.view.pesquisar') }}">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input class="w3-input w3-border" type="text" name="buscar" placeholder="Buscar grupo">
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
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Título</th>
              <th>Data<br/>Criação</th>
              <th>Administrador</th>
              <th>Ações</th>
            </tr>
            @foreach ($grupos as $grupo)
            <tr>
              <td>{{ $grupo->titulo }}</td>
              <td>{{ $grupo->created_at->format('d-m-Y') }}</td>
              <td><?php echo ($grupo->freelancer_id == $freelancer->id)? "Você é o admin" : $grupo->freelancer->nome; ?></td>
              <td>
                @if($grupo->pivot->aceito == 1)
                <a href="/freelancer/grupo/{{ $grupo->id }}" class="w3-button w3-blue w3-small" title="Visualizar e gerenciar o grupo">Visualizar</a>
                @if($grupo->freelancer_id == $freelancer->id)
                <a href="/freelancer/grupo/{{ $grupo->id }}/fechar" class="w3-button w3-red w3-small" title="Fechar o grupo">Fechar</a>
                @endif
                @else
                <a href="/freelancer/grupo/{{ $grupo->id }}/aceitar" class="w3-button w3-blue w3-small" title="Aceitar convite">Aceitar convite</a>
                <a href="/freelancer/grupo/{{ $grupo->id }}/recusar" class="w3-button w3-red w3-small" title="Recusar convite">Recusar convite</a>
                @endif
              </td>
            </tr>
            @endforeach
          </table>
          @if(count($grupos) == 0)
          <div style="text-align: center; margin-top: 10px;">
            Crie seu grupo na opção acima.
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection