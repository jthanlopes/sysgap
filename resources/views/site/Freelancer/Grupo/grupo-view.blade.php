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
          <h3 class="w3-opacity">Grupo {{ $grupo->titulo }} @if(auth()->user()->id == $grupo->freelancer_id) <span class="opt-projeto">[<a href="/freelancer/grupo/{{ $grupo->id }}/editar">Editar grupo</a>]</span>@endif</h3>
          <p class="w3-opacity">Descrição: {{ $grupo->descricao }}</p>
          <p class="w3-opacity">Data de criação: {{ $grupo->created_at->format('d/m/Y') }}</p>
          <a href="/freelancer/grupo/{{ $grupo->id }}/pdf">Gerar relatório do grupo</a>
          <hr>
          <h4 class="w3-opacity">Gerenciar Equipe @if(auth()->user()->id == $grupo->freelancer_id)<span class="opt-projeto">[<a href="/freelancer/grupo/{{ $grupo->id }}/integrante/novo">Adicionar integrante</a>]</span>@endif</h4>
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
            @foreach ($results as $result)
            @foreach ($result->grupos as $grupoFreela)
            @if($grupoFreela->id == $grupo->id)
            <tr>
              <td>{{ $result->nome }}</td>
              <td>{{ $result->email }}</td>
              @if($grupoFreela->pivot->aceito == 0)
              <td>Convite<br/>Enviado</td>
              @elseif($grupoFreela->pivot->aceito == 3)
              <td>Convite<br/>Recusado</td>
              @else
              <td>Ativo</td>
              @endif
              @if(auth()->user()->id == $grupo->freelancer_id && auth()->user()->id != $result->id)
              <td>
                <a href="/freelancer/pesquisa/perfil-freelancer/{{ $result->id }}" class="w3-button w3-blue w3-small" title="Ver perfil do freelancer">Perfil</a>
                <a href="/freelancer/grupo/{{ $grupo->id }}/integrante/{{ $result->id }}/remover" class="w3-button w3-red w3-small" title="Remover freelancer">Remover</a>
              </td>
              @else
              <td>
                <a href="{{ route('freelancer.perfil') }}" class="w3-button w3-blue w3-small" title="Remover freelancer">Meu Perfil</a>
              </td>
              @endif
            </tr>
            @endif
            @endforeach
            @endforeach
          </table>
          <hr>
          <h4 class="w3-opacity">Conhecimentos do grupo</h4>
          <table class="w3-table w3-centered w3-bordered table-conhecimentos">
            <tr>
              <th>Tecnologia</th>
              <th>Descrição</th>
              <th>Nível</th>
            </tr>
            @foreach($results as $result)
            @foreach ($result->conhecimentos as $conhecimento)
            <tr>
              <td>{{ $conhecimento->titulo }}</td>
              <td>{{ $conhecimento->descricao }}</td>
              <td>{{ $conhecimento->nivel }}</td>
              @endforeach
              @endforeach
            </table>
            {{-- @if(count($job->conhecimentos) == 0)
            <div style="text-align: center; margin-top: 10px;">
              Nenhum conhecimento cadastrado para esse job.
            </div>
            @endif --}}
          </div>
        </div>
      </div>
    </div>
    <!-- End Middle Column -->
  </div>
  @endsection