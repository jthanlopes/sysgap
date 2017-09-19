<!-- Navbar -->
<div class="w3-top nav-home">
  <div class="w3-bar w3-red w3-card-2 w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="showNavMobile()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="{{ route('home.page') }}" id="home" class="w3-bar-item w3-button w3-padding-large w3-hover-white">Home</a>
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






{{-- <nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-md-offset-2">
				<div class="navbar-header">
					<a class="navbar-brand" href="/">SysGAP</a>
				</div>
				<ul class="nav navbar-nav">					
					<div class="dropdown">
					<button onclick="myFunction()" class="dropbtn">Job</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="#" onclick="document.getElementById('modal-criar-job').style.display='block'">Criar</a>
							<a href="#">Gerenciar</a>
						</div>
					</div>					
				</ul>
			</div>
			<div class="col-md-4">
				<ul class="nav navbar-nav navbar-right">
					@if (auth()->guard('empresa')->check())
					<li><a href="{{ route('empresa.logout') }}" class="link-logout"><span class="glyphicon glyphicon-log-in"></span> Logout </a></li>
					@else          
					<li><a href="#" class="link-register"><span class="glyphicon glyphicon-user"></span> Cadastrar </a></li>
					<li><a href="#" class="link-login"><span class="glyphicon glyphicon-log-in"></span> Login </a></li>
					@endif
				</ul>
			</nav>

			<!-- The Modal (contains the Sign Up form) -->
			<div id="modal-criar-job" class="modal-job">
				<span onclick="document.getElementById('modal-criar-job').style.display='none'" class="close" title="Close Modal">&times;</span>
				<form class="modal-content-job animate" method="POST" action="{{ route('job.novo') }}">
					{{ csrf_field() }}
					<div class="container-job">
						<div class="form-group">
						<label for="usr">Título do job</label>
							<input type="text" class="form-control" id="titulo" name="titulo">
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nivel">Nível de conhecimento</label>
									<select class="form-control" id="nivel" name="nivel" required>
										<option></option>
										<option value="1">Básico</option>
										<option value="2">Intermediário</option>
										<option value="3">Avançado</option>								
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="status">Status</label>
									<select class="form-control" id="status" name="status" required>
										<option></option>
										<option value="1">Aberto</option>
										<option value="0">Privado</option>															
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="comment">Descrição:</label>
							<textarea class="form-control" rows="5" id="descricao" name="descricao" required></textarea>
						</div>				

						<div class="clearfix">
							<button type="button" onclick="document.getElementById('modal-criar-job').style.display='none'" class="cancelbtn-job">Cancel</button>
							<button class="btn-salvar-job" type="submit" class="signupbtn">Criar</button>
						</div>
					</div>
				</form>
			</div> --}}