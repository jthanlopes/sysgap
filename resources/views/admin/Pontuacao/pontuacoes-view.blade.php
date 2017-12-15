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
    <li><a href="{{ route('noticias.view') }}"><i class="fa fa-circle-o"></i> Notícias </a></li>
    <li><a href="{{ route('conhecimentos.view') }}"><i class="fa fa-circle-o"></i> Conhecimentos </a></li>
    <li><a href="{{ route('itens.view') }}"><i class="fa fa-circle-o"></i> Avaliações </a></li>
    <li><a href="{{ route('pontuacoes.view') }}" style="color: #dd4b39"><i class="fa fa-circle-o"></i> Pontuações </a></li>
  </ul>
</li>
@endsection

@section ('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper noticias-admin">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de itens de pontuação
    </h1>
    <hr>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pontuações</li>
    </ol>
    <a href="{{ route('pontuacao.show-form-novo') }}" class="btn btn-success btn-sm btn-add">
    ADICIONAR NOVO</a>

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
              <th>Descrição</th>
              <th>Valor</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="itens-view">
            @foreach ($pontuacoes as $pontuacao)
            <tr>
              <td>{{ $pontuacao->descricao }}</td>
              <td>{{ $pontuacao->valor }} pontos</td>
              <td>
               <a href="/admin/pontuacao-view/editar/{{ $pontuacao->id }}" class="btn btn-warning">
               Editar</a>
               <a href="/admin/pontuacao-view/excluir/{{ $pontuacao->id }}" class="btn btn-danger">
               Excluir</a>
             </td>
           </tr>
           @endforeach
         </tbody>
       </table>
       <div class="paginacao">
        {{ $pontuacoes->links() }}
      </div>
    </div>
  </div>
</section>
</div>
@endsection