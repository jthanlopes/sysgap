<div id="admin-perfil">
  <!-- Navbar -->
  <div class="w3-top">
   <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
    @if (auth()->guard('empresa')->check())
    <a href="{{ route('empresa.perfil') }}" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Meu Perfil</a>
    <a href="{{ route('empresa.editar-perfil.view') }}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Editar perfil"><i class="fa fa-user"></i></a>
    @elseif (auth()->guard('freelancer')->check())
    <a href="{{ route('freelancer.perfil') }}" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Meu Perfil</a>
    <a href="{{ route('freelancer.editar-perfil.view') }}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Editar perfil"><i class="fa fa-user"></i></a>
    @endif
    {{-- <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a> --}}
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Minha pontuação"><i class="fa fa-check"></i></a>
    @if (auth()->guard('freelancer')->check())
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button w3-padding-large" title="Notificações"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{ count($notificacoes) + count($notificacoes2) }}</span></button>
      <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
        @foreach($notificacoes as $notificacao)
        <a href="{{ route('jobs.projeto.view') }}" class="w3-bar-item w3-button">Convite para o projeto {{ $notificacao->titulo}}</a>
        @endforeach
        @foreach($notificacoes2 as $notificacao)
        @if($notificacao->freelancer_id != auth()->user()->id)
        <a href="{{ route('grupos.view') }}" class="w3-bar-item w3-button">Convite para o grupo {{ $notificacao->titulo}}</a>
        @endif
        @endforeach
        @if(count($notificacoes) == 0 && count($notificacoes2) == 0)
        <p class="w3-bar-item w3-button">Nenhuma nova notificação!</p>
        @endif
      </div>
    </div>
    @elseif (auth()->guard('empresa')->check() && auth()->user()->categoria == "Produtora")
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button w3-padding-large" title="Notificações"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{ count($notificacoes) }}</span></button>
      <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
        @foreach($notificacoes as $notificacao)
        <a href="{{ route('jobs-projeto.view.produtora') }}" class="w3-bar-item w3-button">Convite para o projeto {{ $notificacao->titulo}}</a>
        @endforeach
        @if(count($notificacoes) == 0)
        <p class="w3-bar-item w3-button">Nenhuma nova notificação!</p>
        @endif
      </div>
    </div>
    @endif
    <a href="{{ route('pesquisa.form.usuarios') }}" class="w3-button w3-hide-small w3-padding-large" title="Pesquisar usuários"><i class="fa fa-search"></i></a>
    @if (auth()->guard('empresa')->check())
    <div class="w3-dropdown-hover w3-right">
      <button class="w3-button w3-theme-d4 w3-hide-small ajuste">{{ auth()->guard('empresa')->user()->nome }}</button>
      <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
        <a href="{{ route('home.page') }}" class="w3-bar-item w3-button">Home page</a>
        <a href="{{ route('empresa.logout') }}" class="w3-bar-item w3-button">Logout</a>
      </div>
    </div>
    @elseif (auth()->guard('freelancer')->check())
    <div class="w3-dropdown-hover w3-right">
      <button class="w3-button w3-theme-d4 w3-hide-small ajuste">{{ auth()->guard('freelancer')->user()->nome }}</button>
      <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
        <a href="{{ route('home.page') }}" class="w3-bar-item w3-button">Home page</a>
        <a href="{{ route('freelancer.logout') }}" class="w3-bar-item w3-button">Logout</a>
      </div>
    </div>
    @endif
  </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  @if(auth()->guard('empresa')->check())
  <a href="{{ route('empresa.editar-perfil.view') }}" class="w3-bar-item w3-button w3-padding-large" title="Editar perfil" style="margin-top: 51px;">Editar perfil</a>
  <a href="" class="w3-bar-item w3-button w3-padding-large" title="Editar perfil">Notificações</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large" title="Minha pontuação">Pontuação</a>
  <a href="{{ route('pesquisa.form.usuarios') }}" class="w3-bar-item w3-button w3-padding-large" title="Pesquisar usuários">Pesquisar usuários</a>
  <a href="{{ route('home.page') }}" class="w3-bar-item w3-button w3-padding-large">Home page</a>
  <a href="{{ route('empresa.logout') }}" class="w3-bar-item w3-button w3-padding-large">Logout</a>
  @else
  <a href="{{ route('freelancer.editar-perfil.view') }}" class="w3-bar-item w3-button w3-padding-large" title="Editar perfil" style="margin-top: 51px;">Editar perfil</a>
  <a href="" class="w3-bar-item w3-button w3-padding-large" title="Editar perfil">Notificações</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large" title="Minha pontuação">Pontuação</a>
  <a href="{{ route('home.page') }}" class="w3-bar-item w3-button w3-padding-large">Home page</a>
  <a href="{{ route('freelancer.logout') }}" class="w3-bar-item w3-button w3-padding-large">Logout</a>
  @endif
</div>