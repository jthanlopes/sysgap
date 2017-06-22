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
    <li><a href="{{ route('admins.view') }}" style="color: #dd4b39"><i class="fa fa-circle-o"></i> Administradores</a></li>
    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Notícias </a></li>
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
        Lista de Administradores Inativos
      </h1>
      <hr>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Administradores Inativos</li>
      </ol>
      <a href="{{ route('admin.show-register-form') }}" class="btn btn-success btn-sm btn-add">
      ADICIONAR NOVO</a>
      
       <div class="row">
        <div class="col-lg-6 col-md-offset-2 pesquisa-admin-view">          
            <form class="form-inline" role="form" method="POST" action="{{ route('admins.view-inativos.pesquisar') }}">
              {{ csrf_field() }}
              <input id="pesquisa" type="text" class="form-control" name="pesquisa" placeholder="Pesquisar por nome">              
              <button type="submit" class="btn btn-primary"> Pesquisar </button>              
            </form>          
        </div>
        <div class="col-lg-4 inativos-admins-view">      
          <a href="{{ route('admins.view') }}">Mostrar administradores ativos</a>
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
                <th>Foto Perfil</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Membro desde</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody class="admin-view">
              @foreach ($administradores as $admin)
                <tr>
                  <td>{{ $admin->id }}</td>
                  <td><img src="{{ asset('storage') . '/admins/perfil/' . $admin->profile_photo }}" class="user-image img-circle" alt="User Image"></td>
                  <td>{{ $admin->name }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                  <td><?php echo ($admin->active == 1) ? "Ativo" : "Inativo"; ?></td>
                  <td>                    
                    <a href="{{ route('admin.perfil') }}" class="btn btn-warning">
                      Editar</a>                  
                    <a href="{{ route('admin.ativar', $admin->id) }}" class="btn btn-danger">
                      Ativar</a>                                
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