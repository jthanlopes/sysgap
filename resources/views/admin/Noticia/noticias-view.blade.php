@extends ('admin.layouts.master')

@section ('cadastros')
<li class="active treeview">
  <a href="#">
    <i class="fa fa-dashboard"></i> <span>Cadastros</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{ route('admins.view') }}"><i class="fa fa-circle-o"></i> Administradores</a></li>
    <li><a href="{{ route('noticias.view') }}" style="color: #dd4b39"><i class="fa fa-circle-o"></i> Notícias </a></li>
    <li><a href="{{ route('conhecimentos.view') }}"><i class="fa fa-circle-o"></i> Conhecimentos </a></li>
    <li><a href="{{ route('itens.view') }}"><i class="fa fa-circle-o"></i> Avaliações </a></li>
    <li><a href="{{ route('pontuacoes.view') }}" ><i class="fa fa-circle-o"></i> Pontuações </a>
  </ul>
</li>
@endsection

@section ('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper noticias-admin">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Notícias
    </h1>
    <hr>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Notícias</li>
    </ol>
    <a href="{{ route('noticia.show-form-novo') }}" class="btn btn-success btn-sm btn-add">
    ADICIONAR NOVA</a>

    <div class="row">
      <div class="col-lg-10 col-md-offset-1 pesquisa-admin-view">
        <form class="form-inline" role="form" method="POST" action="{{-- {{ route('noticias.view.pesquisar') }} --}}">
          {{ csrf_field() }}
          <input id="pesquisa" type="text" class="form-control" name="pesquisa" placeholder="Pesquisar por título">
          <button type="submit" class="btn btn-primary"> Pesquisar </button>
        </form>
      </div>
    </div>

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
              <th>Imagem</th>
              <th>Titulo</th>
              <th>Data Cadastro</th>
              <th>Data Final</th>
              <th>Autor</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="noticia-view">
            @foreach ($noticias as $noticia)
            <tr>
              <td><img src="{{ asset('storage') . '/admins/noticias/' . $noticia->imagem }}" class="user-image img-circle" alt="Noticia" style="width: 60%;"></td>
              <td>{{ $noticia->titulo }}</td>
              <td>{{ $noticia->created_at->format('d/m/Y') }}</td>
              <td>{{ $noticia->data_final->format('d/m/Y') }}</td>
              <td>{{ $noticia->admin->name }}</td>
              <td><?php echo ($noticia->ativo == 1) ? "Ativo" : "Inativo"; ?></td>
              <td>
                @if($noticia->ativo == 1)
                <a href="/eventos/evento-view/{{ $noticia->id }}" class="btn btn-info" target="_blank">
                Visualizar</a>
                <a href="{{ route('noticia.inativar', $noticia->id) }}" class="btn btn-danger">
                Inativar</a>
                @else
                <a href="{{ route('noticia.ativar', $noticia->id) }}" class="btn btn-success">
                Ativar</a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="paginacao">
          {{ $noticias->links() }}
        </div>
      </div>
    </div>
  </section>
</div>
@endsection