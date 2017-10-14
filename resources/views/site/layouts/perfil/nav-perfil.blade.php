<div id="admin-perfil">
  <!-- Navbar -->
  <div class="w3-top">
   <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
    @if (auth()->guard('empresa')->check())
    <a href="{{ route('empresa.perfil') }}" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Perfil</a>
    @elseif (auth()->guard('freelancer')->check())
    <a href="{{ route('freelancer.perfil') }}" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Perfil</a>
    @endif
    {{-- <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a> --}}
    <a href="{{ route('empresa.editar-perfil.view') }}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Editar perfil"><i class="fa fa-user"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Mensagens"><i class="fa fa-envelope"></i></a>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button w3-padding-large" title="Notificações"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></button>     
      <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
        <a href="#" class="w3-bar-item w3-button">One new friend request</a>
        <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
        <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
      </div>
    </div>    
    @if (auth()->guard('empresa')->check())    
    <div class="w3-dropdown-hover w3-right">
      <button class="w3-button w3-theme-d4 ajuste">{{ auth()->guard('empresa')->user()->nome }}</button>
      <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
        <a href="{{ route('home.page') }}" class="w3-bar-item w3-button">Home page</a>          
        <a href="{{ route('empresa.logout') }}" class="w3-bar-item w3-button">Logout</a>
      </div>
    </div>
    @elseif (auth()->guard('freelancer')->check())
    <div class="w3-dropdown-hover w3-right">
      <button class="w3-button w3-theme-d4 ajuste">{{ auth()->guard('freelancer')->user()->nome }}</button>
      <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
        <a href="{{ route('home.page') }}" class="w3-bar-item w3-button">Home page</a>          
        <a href="{{ route('freelancer.logout') }}" class="w3-bar-item w3-button">Logout</a>
      </div>
    </div>
    @else
    <div class="w3-dropdown-hover w3-right">
      <button class="w3-button ajuste">Login</button>
      <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
        <a href="{{ route('empresa.login-view') }}" class="w3-bar-item w3-button">Sou empresa</a>
        <a href="{{ route('freelancer.login-view') }}" class="w3-bar-item w3-button">Sou freelancer</a>
      </div>
    </div>
    @endif    
  </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>