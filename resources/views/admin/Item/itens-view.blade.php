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
    <li><a href="{{ route('itens.view') }}" style="color: #dd4b39"><i class="fa fa-circle-o"></i> Avaliações </a></li>
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
      Perguntas das avaliações
    </h1>
    <hr>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Perguntas</li>
    </ol>
    <a href="{{ route('item.show-form-novo') }}" class="btn btn-success btn-sm btn-add">
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
              <th>Pergunta</th>
              <th>Para</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody class="itens-view">
            @foreach ($itens as $item)
            <tr>
              <td>{{ $item->pergunta }}</td>
              <td>{{ $item->destino }}</td>
              <td>
               <a href="/admin/item-view/editar/{{ $item->id }}" class="btn btn-warning">
               Editar</a>
               <a href="/admin/item-view/excluir/{{ $item->id }}" class="btn btn-danger">
               Excluir</a>
             </td>
           </tr>
           @endforeach
         </tbody>
       </table>
       <div class="paginacao">
        {{ $itens->links() }}
      </div>
    </div>
  </div>
</section>
</div>
@endsection