@extends ('site.layouts.master')

@section ('conteudo')

@endsection

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $( "#home, #contato" ).removeClass( "w3-white" );
    $( "#eventos" ).addClass( "w3-white" );
  });
</script>