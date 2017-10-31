
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Bem-vindo(a) ao SysGAP!</title>
  {{-- Bootstrap --}}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body style="margin-left: 5%;">
  <h2>Bem-vindo(a) {{ $freelancer->nome }} ao SysGAP</h1>
    <hr>
    <h4><a href="http://127.0.0.1:8000/freelancer/confirmaConta/{{ $freelancer->account_confirmation }}">Clique aqui</a> para confirmar sua conta.</h4>
    <br/><br/>
    <p>Att,</p>
    <p>Equipe SysGAP</p>
  </body>
  </html>