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
          <h3 class="w3-opacity">Job {{ $job->titulo }} <span class="opt-projeto">[<a href="/empresa/projeto/job/editar/{{ $job->id }}">Editar job</a>]@if($job->status == "Aberto")[<a href="/empresa/projeto/{{ $projeto->id }}/job/finalizar/{{ $job->id }}">Finalizar job</a>]@else[<a href="/empresa/projeto/{{ $projeto->id }}/job/reabrir/{{ $job->id }}">Reabrir job</a>]@endif</span></h3>
          <p class="w3-opacity">Descrição: {{ $job->descricao }}</p>
          <p class="w3-opacity">Status: {{ $job->status }}</p>
          <p class="w3-opacity">Data de criação: {{ $job->created_at->format('d/m/Y') }}</p>
          <hr>
          <h4 class="w3-opacity">Gerenciar Equipe <span class="opt-projeto">[<a href="/empresa/projeto/{{ $projeto->id }}/job/{{ $job->id }}/integrante/novo">Adicionar integrante</a>]</span></h4>
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Ações</th>
            </tr>
            @foreach ($freelancers as $freelancer)
            <tr>
              <td>{{ $freelancer->nome }}</td>
              <td>{{ $freelancer->email }}</td>
              <td><a href="" class="w3-button w3-blue w3-small" title="Enviar e-mail para o freelancer">Enviar E-mail</a>
                <a href="/empresa/projeto/{{ $projeto->id }}/job/{{ $job->id }}/integrante/{{ $freelancer->id }}/remover" class="w3-button w3-red w3-small" title="Remover freelancer">Remover</a>
              </td>
            </tr>
            @endforeach
          </table>
          @if(count($freelancers) == 0)
          <div style="text-align: center; margin-top: 10px;">
            Adicione os integrantes que irão realizar esse job.
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection