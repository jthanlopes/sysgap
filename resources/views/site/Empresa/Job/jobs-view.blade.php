@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Meus Jobs</h3>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <table class="w3-table w3-centered w3-bordered table-jobs">
            <tr>
              <th>Projeto</th>
              <th>Titulo</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
            @foreach ($jobs as $job)
            <tr>
              <td>{{ $job->projeto->titulo }}</td>
              <td>{{ $job->titulo }}</td>
              <td>{{ $job->status }}</td>
              <td>
                <a href="/empresa/job/{{ $job->id }}" class="w3-button w3-blue w3-small" title="Ver o job">Ver</a>
                <a href="" class="w3-button w3-yellow w3-small" title="Devolver o job">Devolver</a>
              </tr>
              @endforeach
            </table>
            @if(count($jobs) == 0)
            <div style="text-align: center; margin-top: 10px;">
              Você não tem nenhum job no momento.
            </div>
            @endif
            <div style="text-align: center;">
              {{ $jobs->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Middle Column -->
  </div>
  @endsection