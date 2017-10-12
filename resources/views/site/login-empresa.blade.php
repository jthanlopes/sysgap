@extends ('site.layouts.home.master')

@section ('conteudo')
<div class="w3-row">
<div class="w3-padding-64 w3-container login" style="width: 25%;margin-left: 37.5%;">
  <div class="w3-content">
    <div class="w3-container">
      <h2>Login Empresa</h2>
      @if(session()->has('message'))
            <div class="alert alert-{{ session()->get('message')['response'] }} alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ session()->get('message')['message'] }}
            </div>
          @endif
      <hr>    
      <form method="POST" action="{{ route('empresa.login') }}">
        {{ csrf_field() }}
        <label><b>E-mail</b></label>
        <input class="w3-input" type="email" placeholder="Digite seu e-mail" name="email" required>

        <label class="ajuste-label-login"><b>Senha</b></label>
        <input class="w3-input" type="password" placeholder="Digite sua senha" name="password" required>
        <div class="g-recaptcha" data-sitekey="6Lev2DMUAAAAABPK5PB2YzHF3jchayKrSbYI0hno" style="margin-top: 20px;"></div>

        <button type="submit" class="btn-default-home">Logar</button>
      </form>
      <div style="text-align: center;">
        <a href="">Esqueceu sua senha?</a> <br/>
        Ainda não tem uma conta? <a href="{{ route('empresa.registro-view') }}">Cadastre-se</a>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $( "#home, .ajuste" ).removeClass( "w3-white" );
    $( ".ajuste" ).addClass( "w3-white" );  
  });
</script>