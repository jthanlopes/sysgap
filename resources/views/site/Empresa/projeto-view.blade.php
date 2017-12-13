@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding projeto-view">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <a href="{{ route('projetos.view') }}" class="link-voltar">ver todos os projetos</a>
          <h3 class="w3-opacity">Projeto {{ $projeto->titulo }} @if($projeto->status == "Aberto")<span class="opt-projeto">[<a href="/empresa/projeto/editar/{{ $projeto->id }}">Editar projeto</a>]</span>@endif</h3>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <p class="w3-opacity">Descrição: {{ $projeto->descricao }}</p>
          <p class="w3-opacity">Status: {{ $projeto->status }}</p>
          <p class="w3-opacity">Data de criação: {{ $projeto->created_at->format('d/m/Y') }}</p>
          <p class="w3-opacity">Número de integrantes: {{ count($freelancers) + count($produtoras) }}</p>
          <p class="w3-opacity">Número de jobs: {{ count($jobs) }}</p>
          @if($projeto->status == "Aberto" || $projeto->status == "Finalizado")<a href="/empresa/projeto/{{ $projeto->id }}/pdf">Gerar relatório do projeto</a>@endif
          <hr>
          <h4 class="w3-opacity">Gerenciar Equipe @if($projeto->status == "Aberto")<span class="opt-projeto">[<a href="/empresa/projeto/{{ $projeto->id }}/integrante/novo">Adicionar integrante</a>]</span>@endif</h4>
          <div class="table-scroll">
            <table class="w3-table w3-centered w3-bordered table-projetos">
              <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
              @foreach ($freelancers as $freelancer)
              @foreach ($freelancer->projetos as $projetoFreela)
              @if($projetoFreela->id == $projeto->id)
              <tr>
                <td><a href="/empresa/pesquisa/perfil-freelancer/{{ $freelancer->id }}">{{ $freelancer->nome }}</a></td>
                <td>{{ $freelancer->email }}</td>
                @if($projetoFreela->pivot->aceito == 0)
                <td>Convite<br/>Enviado</td>
                @elseif($projetoFreela->pivot->aceito == 3)
                <td>Convite<br/>Recusado</td>
                @else
                <td>Ativo</td>
                @endif
                <td>
                  <a href="" class="w3-button w3-blue w3-small" title="Enviar e-mail para o freelancer">Enviar E-mail</a>
                  @if($projetoFreela->pivot->avaliado == 0)
                  <a href="/empresa/projeto/{{ $projeto->id }}/integrante/remover/{{ $freelancer->id }}" class="w3-button w3-red w3-small" title="Remover freelancer">Remover</a>
                  @endif
                </td>
              </tr>
              @endif
              @endforeach
              @endforeach
              @foreach ($produtoras as $produtora)
              @foreach ($produtora->projetos as $projetoProd)
              @if($projetoProd->id == $projeto->id)
              <tr>
                <td><a href="/empresa/pesquisa/perfil-produtora/{{ $produtora->id }}">{{ $produtora->nome }}</a></td>
                <td>{{ $produtora->email }}</td>
                <td><?php echo ($projetoProd->pivot->aceito == 0) ? "Convite<br/>Enviado" : "Ativo"; ?></td>
                <td>
                  <a href="" class="w3-button w3-blue w3-small" title="Enviar e-mail para a produtora">Enviar E-mail</a>
                  <a href="/empresa/projeto/{{ $projeto->id }}/integrante/remover-produtora/{{ $produtora->id }}" class="w3-button w3-red w3-small" title="Remover produtora">Remover</a>
                </td>
              </tr>
              @endif
              @endforeach
              @endforeach
            </table>
          </div>
          @if(count($freelancers) == 0 && count($produtoras) == 0)
          <div style="text-align: center; margin-top: 10px;">
            Adicione os integrantes que participarão deste projeto.
          </div>
          @endif
          <hr>
          <h4 class="w3-opacity">Jobs do Projeto @if($projeto->status == "Aberto")<span class="opt-projeto">[<a href="/empresa/projeto/{{ $projeto->id }}/job/novo">Criar job</a>]</span>@endif</h4>
          <table class="w3-table w3-centered w3-bordered table-projetos">
            <tr>
              <th>Título</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
            @foreach ($jobs as $job)
            <tr>
              <td>{{ $job->titulo }}</td>
              <td>{{ $job->status }}</td>
              <td>
                <a href="/empresa/projeto/{{ $projeto->id }}/job/{{ $job->id }}" class="w3-button w3-blue w3-small" title="Visualizar e editar o projeto">Visualizar</a>
                @if( $job->status == "Aberto")
                <a href="/empresa/projeto/{{ $projeto->id }}/job/finalizar/{{ $job->id }}" class="w3-button w3-red w3-small" title="Finalizar o projeto">Finalizar</a>
                @else
                <a href="/empresa/projeto/{{ $projeto->id }}/job/reabrir/{{ $job->id }}" class="w3-button w3-red w3-small" title="Finalizar o projeto">Reabrir</a>
                @endif
              </td>
            </tr>
            @endforeach
          </table>
          @if(count($jobs) == 0)
          <div style="text-align: center; margin-top: 10px;">
            Crie jobs para este projeto.
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection