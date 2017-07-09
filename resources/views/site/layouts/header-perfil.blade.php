<nav class="navbar navbar-inverse">
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
							<button type="submit" class="signupbtn">Criar</button>
						</div>
					</div>
				</form>
			</div>