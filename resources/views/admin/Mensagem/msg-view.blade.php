@extends ('admin.layouts.master')

@section ('cadastros')
<li class="treeview">
  <a href="#">
    <i class="fa fa-dashboard"></i> <span>Cadastros</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{ route('admins.view') }}"><i class="fa fa-circle-o"></i> Administradores</a></li>
    <li><a href="{{ route('noticias.view') }}"><i class="fa fa-circle-o"></i> Notícias </a></li>
    <li><a href="{{ route('conhecimentos.view') }}"><i class="fa fa-circle-o"></i> Conhecimentos </a></li>
    <li><a href="{{ route('itens.view') }}"><i class="fa fa-circle-o"></i> Itens </a></li>
    <li><a href="{{ route('pontuacoes.view') }}" ><i class="fa fa-circle-o"></i> Pontuações </a>
  </ul>
</li>
@endsection

@section ('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Mensagens</h1>
    <hr>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Mensagens</li>
    </ol>

    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        @if(session()->has('message'))
        <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session()->get('message')['message'] }}
        </div>
        @endif
        <table class="table table-hover table-striped">
          <thead class="thead-inverse">
            <tr>
              <th>Data de envio</th>
              <th>Tipo</th>
              <th>Mensagem</th>
              <th>Email do remetente</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="noticia-view">
            @foreach ($msg as $mensagem)
            <tr>
              <td>{{ $mensagem->created_at }}</td>
              <td>
                @if($mensagem->tipo == 0)
                  Dúvida
                @elseif($mensagem->tipo == 1)
                  Elogio
                @elseif($mensagem->tipo == 2)
                  Reclamação
                @else
                  Sugestão
                @endif
              </td>
              <td>{{ $mensagem->mensagem }}</td>
              <td>{{ $mensagem->email_remetente }}</td>
              <td>
                <a href="" class="btn btn-success">Responder</a>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="paginacao">
            {{ $msg->links() }}
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection