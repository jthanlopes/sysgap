@extends ('site.layouts.master')

@section ('conteudo')
{{-- Overlay mostrado sobre a home page ao carregar a página --}}
<div class="overlay">
  <div class="msg-alerta">
    <h1 class="animate-zoomIn">Página em desenvolvimento.</h1>
    <h3 class="animate-slideInLeft">clique para continuar</h3>        
  </div>
</div>
<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container block-begin">
  <div class="acessibilidade">
    <p><strong>Fonte: </strong></p>
    <img id="diminuir-fonte" src="/site-assets/img/home/diminuirFonte.png" alt="Icone de lupa para diminuir a fonte." title="Diminuir fonte da página.">
    <img id="aumentar-fonte" src="/site-assets/img/home/aumentarFonte.png" alt="Icone de lupa para aumentar a fonte." title="Aumentar fonte da página.">
  </div>
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Sobre o Projeto</h1>
      <h5 class="w3-padding-32">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h5>

      <p class="w3-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div>

      <div class="w3-third w3-center">
        <img src="\site-assets\img\home\projeto.png" alt="Imagem projeto">
      </div>
    </div>
  </div>

  <!-- Second Grid -->
  <div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
    <div class="w3-content">
      <div class="w3-third w3-center">
        <img src="\site-assets\img\home\diferenciais.png" alt="Imagem diferenciais">
      </div>

      <div class="w3-twothird">
        <h1>Diferenciais</h1>
        <h5 class="w3-padding-32">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h5>

        <p class="w3-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
          occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
          laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
      </div>
    </div>

    <div class="w3-container w3-black w3-center w3-opacity w3-padding-64 acessi-text">
      <h1 class="w3-margin w3-xlarge">Lembre-se que o seu mundo é criado na sua cabeça (Ken Keyes Jr.)</h1>
    </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function(){
        $( "#contato, #eventos" ).removeClass( "w3-white" );
        $( "#home" ).addClass( "w3-white" );
      });
    </script>