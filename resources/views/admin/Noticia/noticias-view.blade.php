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
  </ul>
</li>
@endsection

@section ('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">  
      <h1>
        Lista de Notícias
      </h1>
      <hr>
      <ol class="breadcrumb">
        <li><a href="/noticia"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Notícias</li>
      </ol>
      <a href="{{-- {{ route('noticia.show-register-form') }} --}}" class="btn btn-success btn-sm btn-add">
      ADICIONAR NOVA</a>
      
      <div class="row">
        <div class="col-lg-6 col-md-offset-2 pesquisa-admin-view">          
            <form class="form-inline" role="form" method="POST" action="{{-- {{ route('noticias.view.pesquisar') }} --}}">
              {{ csrf_field() }}
              <input id="pesquisa" type="text" class="form-control" name="pesquisa" placeholder="Pesquisar por título">              
              <button type="submit" class="btn btn-primary"> Pesquisar </button>              
            </form>          
        </div>       
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @if(session()->has('message'))
            <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session()->get('message')['message'] }}
            </div>
          @endif
          <table class="table table-hover table-striped">
            <thead class="thead-inverse">
              <tr>            
                <th>Id</th>
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
                  <td>{{ $noticia->id }}</td>
                  <td>Teste Imagem{{-- <img src="{{ asset('storage') . '/noticias/perfil/' . $noticia->profile_photo }}" class="user-image img-circle" alt="User Image"> --}}</td>
                  <td>{{ $noticia->titulo }}</td>
                  <td>{{ $noticia->created_at }}</td>
                  <td>{{ $noticia->data_final }}</td>
                  <td>{{ $noticia->administrador_id }}</td>
                  <td><?php echo ($noticia->active == 1) ? "Ativo" : "Inativo"; ?></td>
                  <td>                    
                    <a href="{{-- {{ route('noticia.perfil') }} --}}" class="btn btn-warning">
                      Editar</a>                    
                    <a href="{{-- {{ route('noticia.inativar', $noticia->id) }} --}}" class="btn btn-danger">
                      Inativar</a>                              
                  </td>
                </tr>       
              @endforeach       
              </tbody>
            </table>    
        </div>
      </div>
    </section>        
  </div>
@endsection