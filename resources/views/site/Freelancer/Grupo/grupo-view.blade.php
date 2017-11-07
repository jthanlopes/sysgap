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
          <h3 class="w3-opacity">Grupo {{ $grupo->titulo }} <span class="opt-projeto">[<a href="/empresa/projeto/job/editar/{{ $grupo->id }}">Editar grupo</a>]</span></h3>
          <p class="w3-opacity">Descrição: {{ $grupo->descricao }}</p>
          <p class="w3-opacity">Data de criação: {{ $grupo->created_at->format('d/m/Y') }}</p>
          <a href="/freelancer/grupo/{{ $grupo->id }}/pdf">Gerar relatório do grupo</a>
          <hr>
          <h4 class="w3-opacity">Gerenciar Equipe <span class="opt-projeto">[<a href="/freelancer/grupo/{{ $grupo->id }}/integrante/novo">Adicionar integrante</a>]</span></h4>
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Ações</th>
            </tr>
            @foreach ($freelancers as $freelancer)
            <tr>
              <td><a href="/empresa/pesquisa/perfil-freelancer/{{ $freelancer->id }}">{{ $freelancer->nome }}</a></td>
              <td>{{ $freelancer->email }}</td>
              <td>{{-- <a href="" class="w3-button w3-blue w3-small" title="Enviar e-mail para o freelancer">Enviar E-mail</a>
                <a href="/empresa/projeto/{{ $projeto->id }}/job/{{ $job->id }}/integrante/{{ $freelancer->id }}/remover" class="w3-button w3-red w3-small" title="Remover freelancer">Remover</a> --}}
              </td>
            </tr>
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
            @foreach($freelancers as $freelancer)
            @foreach ($freelancer->conhecimentos as $conhecimento)
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