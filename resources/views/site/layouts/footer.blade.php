<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
  <p>Powered by Jonathan Lopes</p>
</footer>

{{-- Modais de login e registro--}}

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
            <input type="text" class="form-control" id="cnpj" placeholder="CNPJ" name="cnpj">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="categoria">Foto de perfil:</label>                    
            <input id="input-1a" type="file" class="file" data-show-preview="false">
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" id="cep" placeholder="CEP" name="cep">
            <span class="msg-cep"></span>
          </div>
        </div>
        <div class="col-md-7"></div>
      </div>

      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="logradouro">Logradouro</label>
            <input type="text" class="form-control" id="logradouro" placeholder="Logradouro" name="logradouro" readonly="true">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="logradouro" class="ajuste-input-bottom">Número</label>
            <input type="number" class="form-control" id="numero" placeholder="Número" name="numero" min="1">
          </div>
        </div>                  
        <div class="col-md-4">
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
            <input type="text" class="form-control" id="bairro" placeholder="Bairro" name="bairro" readonly="true">
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" id="cidade" placeholder="Cidade" name="cidade" readonly="true">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="uf">UF</label>
            <input type="text" class="form-control" id="uf" placeholder="UF" name="uf" readonly="true">
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-default btn-default-home">Enviar</button>
    </form>
  </div>         
</div> 

</body>
</html>