@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Job {{ $job->titulo }}</h3>
          <hr>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <p class="w3-opacity">Descrição: {{ $job->descricao }}</p>
          <p class="w3-opacity">Status: {{ $job->status }}</p>
          <p class="w3-opacity">Data de criação: {{ $job->created_at->format('d/m/Y') }}</p>
          <hr>
          <h4 class="w3-opacity">Equipe do job</h4>
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Ações</th>
            </tr>
            @foreach ($freelancers as $freelancerProj)
            <tr>
              <td><a href="/empresa/pesquisa/perfil-freelancer/{{ $freelancerProj->id }}">{{ $freelancerProj->nome }}</a></td>
              <td>{{ $freelancerProj->email }}</td>
              @if($freelancerProj->id == $freelancer->id)
              <td><a href="{{ route('freelancer.perfil') }}" class="w3-button w3-blue w3-small" title="Ir para o meu perfil">Meu perfil</a>
                @else
                <td><a href="" class="w3-button w3-blue w3-small" title="Enviar e-mail para o freelancer">Enviar E-mail</a>
                  @endif
                </td>
              </tr>
              @endforeach
            </table>
            @if(count($freelancers) == 0)
            <div style="text-align: center; margin-top: 10px;">
              Adicione os integrantes que irão realizar esse job.
            </div>
            @endif
            <hr>
            <h4 class="w3-opacity">Conhecimentos Necessários</h4>
            <table class="w3-table w3-centered w3-bordered table-conhecimentos">
              <tr>
                <th>Tecnologia</th>
                <th>Descrição</th>
              </tr>
              @foreach ($job->conhecimentos as $conhecimento)
              <tr>
                <td>{{ $conhecimento->titulo }}</td>
                <td>{{ $conhecimento->descricao }}</td>
              </tr>
              @endforeach
            </table>
            @if(count($job->conhecimentos) == 0)
            <div style="text-align: center; margin-top: 10px;">
              Nenhum conhecimento cadastrado para esse job.
            </div>
            @endif
            <hr>
            <h4 class="w3-opacity">Comentários</h4>
            <form method="POST" action="{{ route('job.add-comentario.freelancer') }}">
              {{ csrf_field() }}
              <input type="hidden" name="jobId" value="{{ $job->id }}">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <textarea class="w3-input w3-border" name="comentario" id="" cols="10" rows="1" placeholder="Faça seu comentário" style="max-width: 100%;"></textarea>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group" style="margin-top: 4px;">
                    <input type="submit" value="Comentar">
                  </div>
                </div>
              </div>
            </form>
            @if(count($comentarios) != 0)
            @foreach ($comentarios as $comentario)
            <div style="margin-top: 10px;">
              <div style="float: left;">
                @if($comentario->freelancer_id == null)
                <img src="{{ asset('storage') . '/empresas/perfil/' . $comentario->empresa->foto_perfil }}" style="height:60px;width:60px;" alt="Imagem da empresa">
                @else
                <img src="{{ asset('storage') . '/freelancers/perfil/' . $comentario->freelancer->foto_perfil }}" style="height:60px;width:60px;" alt="Imagem do freelancer">
                @endif
              </div>
              <div style="float: left; margin-left: 10px;">
                @if($comentario->freelancer_id == null)
                <p style="margin-bottom: 0;">{{ $comentario->empresa->nome }} @if($job->empresa_id == $comentario->empresa->id) (admin) @endif</p>
                <p>{{ $comentario->empresa->email }}</p>
                @else
                <p style="margin-bottom: 0;">{{ $comentario->freelancer->nome }}</p>
                <p>{{ $comentario->freelancer->email }}</p>
                @endif
              </div>
            </div>

            <div style="clear: both; border-left: 6px solid #7d97a5; background-color: #f5f7f8; padding: 10px; margin-top: 100px;">
              <p>{{ $comentario->comentario }}</p>
            </div>

            <div style="float: right;">
              <p>{{ $comentario->created_at->diffForHumans() }}</p>
            </div>
            <div style="clear: both;">
              <hr>
            </div>
            @endforeach
            @else
            <div style="text-align: center; margin-top: 10px;">
              <p>Nenhum comentário feito neste job!</p>
            </div>
            @endif
            <div style="text-align: center;">
              {{ $comentarios->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Middle Column -->
  </div>
  @endsection