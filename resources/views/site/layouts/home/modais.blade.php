{{-- Modais de login e registro--}}
{{-- Modal de registro da empresa --}}
<div id="modal-register-empresa" class="modal-register" role="dialog">

  <!-- Modal content-->
  <div class="modal-content-register animate">
    <div class="modal-header-register">
      <span onclick="document.getElementById('modal-register-empresa').style.display='none'" class="close-register" title="Close Modal Register">×</span>
      <h2 class="modal-title">Cadastre sua Empresa</h2>
      <hr>
    </div>
    <div class="modal-body-register">
     <form method="POST" action="{{ route('empresa.novo') }}" enctype="multipart/form-data">
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
            <label for="categoria" class="ajuste-input-bottom">Categoria:</label>
            <select class="form-control" id="categoria" name="categoria" required>                        
              <option value="agência">Agência</option>
              <option value="produtora">Produtora</option>
              <option value="outra_empresa">Outra empresa</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="cnpj">CNPJ:</label>
            <input type="text" class="form-control cnpj" placeholder="CNPJ" name="cnpj">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="categoria">Foto de perfil:</label>                    
            <input id="input-1a" type="file" class="file" data-show-preview="false" name="profile_photo">
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control cep" placeholder="CEP" name="cep">
            <span class="msg-cep"></span>
          </div>
        </div>
        <div class="col-md-7"></div>
      </div>

      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="logradouro">Logradouro</label>
            <input type="text" class="form-control logradouro" placeholder="Logradouro" name="logradouro" readonly="true">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="logradouro" class="ajuste-input-bottom">Número</label>
            <input type="number" class="form-control numero" placeholder="Número" name="numero" min="1">
          </div>
        </div>                  
        <div class="col-md-4">
          <div class="form-group">
            <label for="complemento">Complemento</label>
            <input type="text" class="form-control complemento" placeholder="Complemento" name="complemento">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control bairro" placeholder="Bairro" name="bairro" readonly="true">
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control cidade" placeholder="Cidade" name="cidade" readonly="true">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="uf">UF</label>
            <input type="text" class="form-control uf" placeholder="UF" name="uf" readonly="true">
          </div>
        </div>
      </div>
      <hr>
      <button type="submit" class="btn btn-default btn-default-home">Enviar</button>
    </form>
  </div>
</div>
</div>

{{-- Modal de registro do freelancer --}}
<div id="modal-register-freelancer" class="modal-register" role="dialog">

  <!-- Modal content-->
  <div class="modal-content-register animate">
    <div class="modal-header-register">
      <span onclick="document.getElementById('modal-register-freelancer').style.display='none'" class="close-register" title="Close Modal Register">×</span>
      <h2 class="modal-title">Cadastro de freelancer</h2>
      <hr>
    </div>
    <div class="modal-body-register">
     <form method="POST" action="{{ route('freelancer.novo') }}" enctype="multipart/form-data">
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
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control cpf" placeholder="CPF" name="cpf">
          </div>
        </div>      
        <div class="col-md-6">
          <div class="form-group">
            <label for="categoria" class="ajuste-input-bottom">Foto de perfil:</label>                    
            <input id="input-1a" type="file" class="file" data-show-preview="false" name="profile_photo">
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control cep" placeholder="CEP" name="cep">
            <span class="msg-cep"></span>
          </div>
        </div>
        <div class="col-md-7"></div>
      </div>

      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="logradouro">Logradouro</label>
            <input type="text" class="form-control logradouro" placeholder="Logradouro" name="logradouro" readonly="true">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="logradouro" class="ajuste-input-bottom">Número</label>
            <input type="number" class="form-control numero" placeholder="Número" name="numero" min="1">
          </div>
        </div>                  
        <div class="col-md-4">
          <div class="form-group">
            <label for="complemento">Complemento</label>
            <input type="text" class="form-control complemento" placeholder="Complemento" name="complemento">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control bairro" placeholder="Bairro" name="bairro" readonly="true">
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control cidade" placeholder="Cidade" name="cidade" readonly="true">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="uf">UF</label>
            <input type="text" class="form-control uf" placeholder="UF" name="uf" readonly="true">
          </div>
        </div>
      </div>
      <hr>
      <button type="submit" class="btn btn-default btn-default-home">Enviar</button>
    </form>
  </div>
</div>
</div>

<div id="modal-login-empresa" class="modal">  
  <form class="modal-content" method="POST" action="{{ route('empresa.login') }}">    
    {{ csrf_field() }}
    <div class="imgcontainer">
      <h3>Login de empresa</h3>
      <hr>
    </div>

    <div class="container-modal">
      <label><b>E-mail</b></label>
      <input type="email" placeholder="Digite seu e-mail" name="email" required>

      <label><b>Senha</b></label>
      <input type="password" placeholder="Digite sua senha" name="password" required>

      <button type="submit" class="btn-default-home">Logar</button>
      <input type="checkbox" checked="checked"> Lembre-me
    </div>

    <div class="container-modal" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('modal-login-empresa').style.display='none'" class="cancelbtn">Cancelar</button>
      <span class="psw">Esqueceu sua <a href="#">senha?</a></span>
    </div>
  </form>
</div>

<div id="modal-login-freelancer" class="modal">

  <form class="modal-content" method="POST" action="{{ route('freelancer.login') }}">
    {{ csrf_field() }}
    <div class="imgcontainer">
      <h3>Login de freelancer</h3>
      <hr>
    </div>

    <div class="container-modal">
      <label><b>E-mail</b></label>
      <input type="email" placeholder="Digite seu e-mail" name="email" required>

      <label><b>Senha</b></label>
      <input type="password" placeholder="Digite sua senha" name="password" required>

      <button type="submit" class="btn-default-home">Logar</button>
      <input type="checkbox" checked="checked"> Lembre-me
    </div>

    <div class="container-modal" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('modal-login-freelancer').style.display='none'" class="cancelbtn">Cancelar</button>
      <span class="psw">Esqueceu sua <a href="#">senha?</a></span>
    </div>
  </form>
</div>