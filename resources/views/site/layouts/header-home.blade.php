<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 col-md-offset-2">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">SysGAP</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Projeto</a></li>
          <li><a href="#">Contato</a></li>
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
        <div class="login-options">
          <div class="options-text">
            <h4>Opções de login:</h4>
          </div>

          <div class="options-buttons-login">
            <p><button class="btn-login-home" onclick="document.getElementById('modal-login-empresa').style.display='block'">Sou Empresa</button></p>
            <p><button class="btn-login-home" onclick="document.getElementById('modal-login-freelancer').style.display='block'">Sou Freelancer</button></p>
          </div>        
        </div>   

        <div class="register-options">
          <div class="options-text">
            <h4>Opções de cadastro:</h4>
          </div>

          <div class="options-buttons-register">
            <p><button class="btn-register-home" onclick="document.getElementById('modal-register-empresa').style.display='block'">Sou Empresa</button></p>
            <p><button class="btn-register-home">Sou Freelancer</button></p>
          </div>        
        </div> 

        <div id="modal-login-empresa" class="modal">

          <form class="modal-content animate" method="POST" action="{{ route('empresa.login') }}">
            {{ csrf_field() }}
            <div class="imgcontainer">
              <span onclick="document.getElementById('modal-login-empresa').style.display='none'" class="close" title="Close Modal">&times;</span>
              <img src="/site-assets/img/home/icone_empresa_login.png" alt="Avatar" class="avatar">
            </div>

            <div class="container-modal">
              <label><b>E-mail</b></label>
              <input type="text" placeholder="Digite seu e-mail" name="email" required>

              <label><b>Senha</b></label>
              <input type="password" placeholder="Digite sua senha" name="password" required>

              <button type="submit">Logar</button>
              <input type="checkbox" checked="checked"> Lembre-me
            </div>

            <div class="container-modal" style="background-color:#f1f1f1">
              <button type="button" onclick="document.getElementById('modal-login-empresa').style.display='none'" class="cancelbtn">Cancelar</button>
              <span class="psw">Esqueceu sua <a href="#">senha?</a></span>
            </div>
          </form>
        </div>

        <div id="modal-login-freelancer" class="modal">

          <form class="modal-content animate" method="POST" action="{{ route('empresa.login') }}">
            {{ csrf_field() }}
            <div class="imgcontainer">
              <span onclick="document.getElementById('modal-login-freelancer').style.display='none'" class="close" title="Close Modal">&times;</span>
              <img src="/site-assets/img/home/icone_freelancer_login.png" alt="Avatar" class="avatar-2">
            </div>

            <div class="container-modal">
              <label><b>E-mail</b></label>
              <input type="text" placeholder="Digite seu e-mail" name="email" required>

              <label><b>Senha</b></label>
              <input type="password" placeholder="Digite sua senha" name="password" required>

              <button type="submit">Logar</button>
              <input type="checkbox" checked="checked"> Lembre-me
            </div>

            <div class="container-modal" style="background-color:#f1f1f1">
              <button type="button" onclick="document.getElementById('modal-login-freelancer').style.display='none'" class="cancelbtn">Cancelar</button>
              <span class="psw">Esqueceu sua <a href="#">senha?</a></span>
            </div>
          </form>
        </div>


        <div id="modal-register-empresa" class="modal-register fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;Cadastro Empresa</h4>
              </div>
              <div class="modal-body">
               <form method="POST" action="{{ route('empresa.novo') }}">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome">Nome:</label>
                      <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="text" class="form-control" id="email" placeholder="E-mail" name="email">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="senha">Senha:</label>
                      <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="confirmaSenha">Confirmação de senha:</label>
                      <input type="password" class="form-control" id="confirmaSenha" placeholder="Senha" name="confirmaSenha">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="categoria">Categoria:</label>
                      <input type="text" class="form-control" id="categoria" placeholder="Categoria" name="categoria">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cnpj">CNPJ:</label>
                      <input type="text" class="form-control" id="cnpj" placeholder="CNPJ" name="cnpj">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="categoria">Foto de perfil:</label>
                      <input id="input-1" type="file" class="file" name="profile_photo" placeholder="Envie a foto de perfil" />
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="cep">CEP</label>
                      <input type="text" class="form-control" id="cep" placeholder="CEP" name="cep">
                    </div>
                  </div>
                  <div class="col-md-7"></div>
                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="logradouro">Logradouro</label>
                      <input type="text" class="form-control" id="logradouro" placeholder="Logradouro" name="logradouro">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="numero">Numero</label>
                      <input type="number" class="form-control" id="numero" placeholder="Número" name="numero">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="complemento">Complemento</label>
                      <input type="text" class="form-control" id="complemento" placeholder="Complemento" name="complemento">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="bairro">Bairro</label>
                      <input type="text" class="form-control" id="bairro" placeholder="Bairro" name="bairro">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="cidade">Cidade</label>
                      <input type="text" class="form-control" id="cidade" placeholder="Cidade" name="cidade">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="uf">UF</label>
                      <input type="text" class="form-control" id="uf" placeholder="UF" name="uf">
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div id="modal-login" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><span class="glyphicon glyphicon-usd"></span>&nbsp;Cadastro Freelancer</h4>
            </div>
            <div class="modal-body">
              <form>
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">
                  <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Check me out
                  </label>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>      
    </div> 
  </div>
</div>
</nav>