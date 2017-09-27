@extends ('site.layouts.home.master')

@section ('conteudo')
<div class="w3-row-padding w3-padding-64 w3-container block-begin login">
  <div class="w3-content">
    <div class="w3-container">
      <h2>Login Empresa</h2>
      <hr>    
      <form method="POST" action="{{ route('empresa.login') }}">
        {{ csrf_field() }}
        <label><b>E-mail</b></label>
        <input class="w3-input" type="email" placeholder="Digite seu e-mail" name="email" required>

        <label class="ajuste-label-login"><b>Senha</b></label>
        <input class="w3-input" type="password" placeholder="Digite sua senha" name="password" required>

        <button type="submit" class="btn-default-home">Logar</button>
      </form>
      <div style="text-align: center;">
        <a href="">Esqueceu sua senha?</a> <br/>
        Ainda não tem uma conta? <a href="{{ route('empresa.registro-view') }}">Cadastre-se</a>
      </div>
    </div>
  </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $( "#home, .ajuste" ).removeClass( "w3-white" );
    $( ".ajuste" ).addClass( "w3-white" );

    var navHeight = $('.nav-home').height();
    $('html, body').animate({
      scrollTop: $(".block-begin").offset().top - navHeight
            }, 800); // Tempo em ms que a animação irá durar
  });
</script>