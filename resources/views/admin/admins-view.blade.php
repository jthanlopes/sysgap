@extends ('admin.layouts.master')

@section ('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">  
      <h1>
        Lista de Administradores
      </h1>
      <hr>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Administradores</li>
      </ol>
      <a href="{{ route('register') }}" class="btn btn-success btn-sm btn-add">
      ADICIONAR NOVO</a>

      <div class="row">
        <div class="col-md-8">
          <table class="table table-hover table-striped">
            <thead class="thead-inverse">
              <tr>            
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Membro desde</th>
                <th>Ativo?</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($administradores as $admin)
                <tr>
                  <th scope="row">{{ $admin->id }}</th>
                  <td>{{ $admin->name }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>{{ $admin->created_at }}</td>
                  <td><?php echo ($admin->active == 1) ? "Sim" : "Não"; ?></td>
                </tr>       
              @endforeach       
              </tbody>
            </table>    
        </div>
      </div>
    </section>        
  </div>
@endsection