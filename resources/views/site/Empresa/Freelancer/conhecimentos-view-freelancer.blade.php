<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <title>SysGAP - Visualização de Perfil</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  {{-- Icones Google --}}
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  {{-- Bower_components --}}
  <link href="/bower_resources/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  {{-- Css Home --}}
  <link rel="stylesheet" href="/site-assets/css/perfil.css">
  {{-- Css Geral --}}
  <link rel="stylesheet" href="/site-assets/css/style.css" />
  {{-- Css W3C --}}
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
  html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif;}
</style>
</head>
<body class="w3-theme-l5">
  @include ('site.layouts.perfil.nav-perfil')
  <!-- Page Container -->
  <div id="" class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- The Grid -->
    <div class="w3-row">
      <!-- Left Column -->
      <div class="w3-col m3">
        <!-- Profile -->
        <div class="w3-card-2 w3-round w3-white">
          <div class="w3-container">
           <h4 class="w3-center">Perfil Freelancer</h4>
           <p class="w3-center"><img src="{{ asset('storage') . '/freelancers/perfil/' . $freelancer->foto_perfil }}" class="w3-circle" style="height:164px;width:164px" alt="Imagem da freelancer"></p>
           <hr>
           <div style="text-align: center;">
             <p title="Nome de usuário">{{ $freelancer->nome }}</p>
             <p title="E-mail">{{ $freelancer->email }}</p>
             <p title="Data de cadastro">{{ $freelancer->created_at->format('d/m/Y') }}</p>
           </div>
         </div>
       </div>
       <br>

       <!-- Accordion -->
       <div class="w3-card-2 w3-round">
        <div class="w3-white groups">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Grupos</button>
          <div id="Demo1" class="w3-hide w3-container">
            <hr>
            <p><a href="">Grupo 1</a></p>
            <p><a href="">Grupo 2</a></p>
            <p><a href="">Grupo 3</a></p>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> Avaliações</button>
          <div id="Demo2" class="w3-hide w3-container">
            <hr>
            <p><a href="">Avaliações recebidas</a></p>
            <p><a href="">Avaliações feitas</a></p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Portifólio</button>
          <div id="Demo3" class="w3-hide w3-container">
           <div class="w3-row-padding">
             <hr>
             @if(auth()->guard('empresa')->check())
             <p><a href="/empresa/pesquisa/perfil-freelancer/portifolios/{{ $freelancer->id }}">Ver portifólios</a></p>
             @else
             <p><a href="/freelancer/pesquisa/perfil-freelancer/portifolios/{{ $freelancer->id }}">Ver portifólios</a></p>
             @endif
           </div>
         </div>
       </div>
     </div>
     <br>

     <!-- Interests -->
     <div class="w3-card-2 w3-round w3-white w3-hide-small">
      <div class="w3-container">
        @if(auth()->guard('empresa')->check())
        <p>Conhecimentos <span class="opt-tec">[<a href="/empresa/pesquisa/perfil-freelancer/conhecimentos/{{ $freelancer->id }}">Ver detalhes</a>]</span></p>
        @else
        <p>Conhecimentos <span class="opt-tec">[<a href="/freelancer/pesquisa/perfil-freelancer/conhecimentos/{{ $freelancer->id }}">Ver detalhes</a>]</span></p>
        @endif
        <p>
          <p>
            @foreach ($freelancer->conhecimentos as $conhecimento)
            <span class="w3-tag w3-small w3-theme-l{{ rand(1, 5) }}">{{ $conhecimento->titulo }}</span>
            @endforeach
          </p>
        </p>
      </div>
    </div>
    <br>
    <!-- End Left Column -->
  </div>
  <!-- Middle Column -->
  <div class="w3-col m7">

    <div class="w3-row-padding">
      <div class="w3-col m12">
        <div class="w3-card-2 w3-round w3-white">
          <div class="w3-container w3-padding">
            <h3 class="w3-opacity">Conhecimentos</h3>
            @if(session()->has('message'))
            <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session()->get('message')['message'] }}
            </div>
            @endif
            <hr>
            <table class="w3-table w3-centered w3-bordered table-conhecimentos">
              <tr>
                <th>Tecnologia</th>
                <th>Descrição</th>
                <th>Tempo<br>Experiência</th>
                <th>Nível</th>
              </tr>
              @foreach ($freelancer->conhecimentos as $conhecimento)
              <tr>
                <td>{{ $conhecimento->titulo }}</td>
                <td>{{ $conhecimento->descricao }}</td>
                <td>{{ $conhecimento->pivot->tempo_experiencia }}</td>
                <td>{{ $conhecimento->nivel }}</td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- End Middle Column -->
  </div>
  <!-- Right Column -->
  <div class="w3-col m2">
    <div class="w3-card-2 w3-round w3-white w3-center">
      <div class="w3-container">
        <p>Upcoming Events:</p>
        <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
        <p><strong>Holiday</strong></p>
        <p>Friday 15:00</p>
        <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
      </div>
    </div>
    <br>
    <div class="w3-card-2 w3-round w3-white w3-center">
      <div class="w3-container">
        <p>Friend Request</p>
        <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
        <span>Jane Doe</span>
        <div class="w3-row w3-opacity">
          <div class="w3-half">
            <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
          </div>
          <div class="w3-half">
            <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
          </div>
        </div>
      </div>
    </div>
    <br>
    <!-- End Right Column -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Page Container -->
</div>
<br>
<!-- Snackbar cadastro de Job -->
{{-- <div class="snackbar">Job cadastrado com sucesso.</div> --}}
@include ('site.layouts.perfil.footer')
@include ('site.layouts.perfil.scripts')