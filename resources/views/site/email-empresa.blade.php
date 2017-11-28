@extends ('site.layouts.home.master')

@section ('conteudo')
<div class="w3-row">
  <div class="w3-padding-64 w3-container login">
    <div class="w3-content">
      <div class="w3-container">
        <h3>Resetar Senha</h3>
        @if (session('status'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
        </div>
        @endif
        <hr>
        <form role="form" method="POST" action="{{ route('empresa.reseta-senha.email') }}">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label><b>E-mail</b></label>
            <input id="email" class="w3-input" type="email" placeholder="Digite seu e-mail" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              Enviar link para recuperar a senha
            </button>
          </div>
        </form>
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