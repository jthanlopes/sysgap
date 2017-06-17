@extends ('admin.layouts.master')

@section ('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administradores
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Administradores</li>
      </ol>
    </section>    
    <a href="{{ route('register') }}" class="btn btn-success btn-sm">
    ADICIONAR</a>
  </div>
@endsection