@extends ('admin.layouts.master')

@section ('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Gráficos de {{ $tipo }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Gráficos {{ $tipo }}</li>
    </ol>
  </section>
  <hr>
  <div>
    {!! $chart->render() !!}
  </div>
  <div style="margin-top: 30px;">
    {!! $chart2->render() !!}
  </div>
  <div style="margin-top: 30px;">
    {!! $chart3->render() !!}
  </div>
</div>
@endsection