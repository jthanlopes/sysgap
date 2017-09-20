<div id="home-page">
<!-- Navbar -->
<div class="w3-top nav-home">
  <div class="w3-bar w3-red w3-card-2 w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="showNavMobile()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="{{ route('home.page') }}" id="home" class="w3-bar-item w3-button w3-padding-large w3-hover-white"><i class="fa fa-home w3-margin-right"></i>Home</a>
    <a href="{{ route('eventos.page') }}" id="eventos" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Eventos</a>
    <a href="{{ route('contato.page') }}" id="contato" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Contato</a>
    @if (auth()->guard('empresa')->check())
    <a href="{{ route('empresa.logout') }}" id="contato" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right">Logout</a>
    @elseif (auth()->guard('freelancer')->check())
    <a href="{{ route('freelancer.logout') }}" id="contato" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right">Logout</a>
    @else
    <div class="w3-dropdown-hover">
      <button class="w3-button ajuste">Registro</button>
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="#" class="w3-bar-item w3-button" onclick="document.getElementById('modal-register-empresa').style.display='block'">Sou empresa</a>
        <a href="#" class="w3-bar-item w3-button" onclick="document.getElementById('modal-register-freelancer').style.display='block'">Sou freelancer</a>
      </div>
    </div>  
    <div class="w3-dropdown-hover w3-right">
      <button class="w3-button ajuste">Login</button>
      <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
        <a href="#" class="w3-bar-item w3-button" onclick="document.getElementById('modal-login-empresa').style.display='block'">Sou empresa</a>
        <a href="#" class="w3-bar-item w3-button" onclick="document.getElementById('modal-login-freelancer').style.display='block'">Sou freelancer</a>
      </div>
    </div>
    @endif
    <div class="w3-dropdown-hover w3-right">
      @if (auth()->guard('empresa')->check())
      <a href="{{ route('empresa.perfil') }}" id="empresa-perfil" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Perfil</a>
      @elseif (auth()->guard('freelancer')->check())
      <a href="{{ route('freelancer.perfil') }}" id="freelancer-perfil" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Perfil</a>
      @endif
    </div>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="{{ route('eventos.page') }}" class="w3-bar-item w3-button w3-padding-large">Eventos</a>
    <a href="{{ route('contato.page') }}" class="w3-bar-item w3-button w3-padding-large">Contato</a>    
  </div>
</div>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function showNavMobile() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

