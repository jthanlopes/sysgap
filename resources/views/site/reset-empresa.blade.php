@extends ('site.layouts.home.master')

@section ('conteudo')
<div class="w3-row">
  <div class="w3-padding-64 w3-container login">
    <div class="w3-content">
      <div class="w3-container">
        <h2>Resetar Senha</h2>
        <hr>
        <form role="form" method="POST" action="{{ route('empresa.reseta-senha.request') }}">
          {{ csrf_field() }}

          <input type="hidden" name="token" value="{{ $token }}">

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">E-Mail</label>
            <input id="email" type="email" class="w3-input" name="email" value="{{ $email or old('email') }}" required autofocus>
            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password">Senha</label>
          <input id="password" type="password" class="w3-input" name="password" required>
          @if ($errors->has('password'))
          <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>

      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm">Confirmação de senha</label>
        <input id="password-confirm" type="password" class="w3-input" name="password_confirmation" required>
        @if ($errors->has('password_confirmation'))
        <span class="help-block">
          <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
        @endif
      </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">
        Resetar senha
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