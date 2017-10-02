<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Bem-vindo(a) ao SYSGAP!</title>
</head>
<body>
  <h2>Bem-vindo(a) {{ $empresa->nome }}</h1>
  <hr>
  <h3>Acesse o link: <a href="http://127.0.0.1:8000/empresa/confirmaConta/{{ $empresa->remember_token }}">Link</a> para confirmar sua conta.</h3>
</body>
</html>