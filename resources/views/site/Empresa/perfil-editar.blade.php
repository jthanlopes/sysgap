@extends ('site.layouts.perfil.master-perfil')

@section ('conteudo')
<!-- Middle Column -->
<div class="w3-col m7">

  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container w3-padding">
          <h3 class="w3-opacity">Editar Perfil</h3>
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message')['message'] }}
          </div>
          @endif
          <hr>
          <h5 class="w3-opacity">Informações pessoais</h5>
          <form method="POST" action="{{ route('empresa.novo') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input type="text" class="w3-input" id="nome" value="{{ $empresa->nome }}" placeholder="Nome" name="nome" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="text" class="w3-input" id="email" value="{{ $empresa->email }}" placeholder="E-mail" name="email" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="senha">Senha:</label>
                  <input type="password" class="w3-input" id="senha" placeholder="Senha" name="senha" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="confirmaSenha">Confirmação de senha:</label>
                  <input type="password" class="w3-input" id="confirmaSenha" placeholder="Senha" name="confirmaSenha" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="categoria">Categoria:</label>
                  <select class="w3-select" id="categoria" name="categoria" required>
                    <option value="Agência">Agência</option>
                    <option value="Produtora">Produtora</option>
                    <option value="Empresa">Outra empresa</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cnpj">CNPJ:</label>
                  <input type="text" class="w3-input cnpj" value="{{ $empresa->cnpj }}" placeholder="CNPJ" name="cnpj" required>
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
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <button type="submit" class="btn btn-default btn-default-home">Editar</button>
                </div>
              </div>
            </div>
          </form>
          <form method="POST" action="{{ route('empresa.editar.endereco') }}">
            {{ csrf_field() }}
            <hr>
            <input type="hidden" name="enderecoId" value="{{ $empresa->endereco->id }}">
            <h5 class="w3-opacity">Endereço</h5>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="cep">CEP</label>
                  <input type="text" class="w3-input cep" value="{{ $empresa->endereco->cep }}" placeholder="CEP" name="cep" required>
                  <span class="msg-cep"></span>
                </div>
              </div>
              <div class="col-md-7"></div>
            </div>

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="logradouro">Logradouro</label>
                  <input type="text" class="w3-input logradouro" value="{{ $empresa->endereco->logradouro }}" placeholder="Logradouro" name="logradouro" readonly="true" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="logradouro">Número</label>
                  <input type="number" class="w3-input numero" value="{{ $empresa->endereco->numero }}" placeholder="Número" name="numero" min="1" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="complemento">Complemento</label>
                  <input type="text" class="w3-input complemento" value="{{ $empresa->endereco->complemento }}" placeholder="Complemento" name="complemento">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="bairro">Bairro</label>
                  <input type="text" class="w3-input bairro" value="{{ $empresa->endereco->bairro }}" placeholder="Bairro" name="bairro" readonly="true" required>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="cidade">Cidade</label>
                  <input type="text" class="w3-input cidade" value="{{ $empresa->endereco->cidade }}" placeholder="Cidade" name="cidade" readonly="true" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="uf">UF</label>
                  <input type="text" class="w3-input uf" value="{{ $empresa->endereco->uf }}" placeholder="UF" name="uf" readonly="true" required>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-default btn-default-home">Editar</button>
          </form>
          <div class="">
            <hr>
            <button class="w3-button w3-red w3-small" title="Desativar Perfil">Desativar Perfil</button></td>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Middle Column -->
</div>
@endsection