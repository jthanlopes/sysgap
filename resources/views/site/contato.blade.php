@extends ('site.layouts.master')

@section ('conteudo')
<div class="w3-row-padding w3-padding-64 w3-container block-begin contato">
  <div class="w3-content">
    <div class="w3-container">
      <h2>Formulário de Contato</h2>
      <hr>
    </div>

    <form class="w3-container">
      <p>
        <label>Nome</label><br/>
        <input class="w3-input w3-animate-input input-contato-nome" type="text" style="width:50%" placeholder="Nome" required=""></p>        
        <p>
          <label>E-mail</label><br/>
          <input class="w3-input w3-border w3-animate-input input-contato-email" type="email" style="width:50%" placeholder="E-mail" required=""></p>
          <p><label>Mensagem</label><br/>
            <textarea class="textarea-contato-msg" name="msg" cols="30" rows="10" style="width: 100%" placeholder="Dúvidas, elogios ou sugestões." required=""></textarea></p>
            <hr>
            <button type="submit" class="btn btn-default btn-default-home btn-msg-contato">Enviar</button>
          </form>
          <!-- The actual snackbar -->
          <div class="snackbar">Mensagem enviada com sucesso!</div>
          {{-- @include ('site.layouts.footer') --}}
        </div>
      </div>
      @endsection

      <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
      <script>
        $(document).ready(function(){
          $( "#home, #eventos" ).removeClass( "w3-white" );
          $( "#contato" ).addClass( "w3-white" );
          
          var navHeight = $('.nav-home').height();
          $('html, body').animate({
            scrollTop: $(".block-begin").offset().top - navHeight
            }, 800); // Tempo em ms que a animação irá durar
        });
      </script>