var loadImages;

$(document).ready(function(){
	// Exibe overlay ao abrir a home-page
	$(".overlay").css({ display: "block" });
	// Acrescenta a animação ao overlay
	$('.animate-zoomIn').addClass('animated zoomIn');
	$('.animate-slideInLeft').addClass('animated slideInLeft');

	// Fecha overlay da home ao clicar nele
	$(".overlay").click(function(event){
		$(this).css({display: "none"});
		$('.animate-fadeIn').addClass('animated fadeIn');
	});

  // Aplica a maskara de campos aos inputs
  $(".cnpj").mask('00.000.000/0000-00', {reverse: true});
  $(".cpf").mask('000.000.000-00', {reverse: true});
  $(".cep").mask('00000-000');

 	// Scrolar a página ao clicar em Começar
 	$('.scroll-begin').click(function () {
 		var navHeight = $('.nav-home').height();
 		$('html, body').animate({
 			scrollTop: $(".block-begin").offset().top - navHeight
        }, 600); // Tempo em ms que a animação irá durar
 	});

 	$(".link-login, .btn-login-home").click(function(event){
 		$(".link-register").removeClass("link-active");
 		$(".register-options").slideUp('200');

 		$(".link-login").toggleClass("link-active");
 		$(".login-options").slideToggle('200');
 	});

 	$(".link-register, .btn-register-home").click(function(event){
 		$(".link-login").removeClass("link-active");
 		$(".login-options").slideUp('200');

 		$(".link-register").toggleClass("link-active");
 		$(".register-options").slideToggle('200');
 	});

 	$("#modal-login-empresa").click(function(event){
 		var modal = document.getElementById('modal-login-empresa');
 		if (event.target == modal) {
 			modal.style.display = "none";
 		}
 	});

 	$("#modal-login-freelancer").click(function(event){
 		var modal = document.getElementById('modal-login-freelancer');
 		if (event.target == modal) {
 			modal.style.display = "none";
 		}
 	});

 	$("#modal-register-empresa").click(function(event){
 		var modal = document.getElementById('modal-register-empresa');
 		var modal2 = $(".modal-dialog");
 		if (event.target == modal || event.target == modal2) {
 			$(this).css("display", "none");
 		}
 	});

 	$("#modal-register-freelancer").click(function(event){
 		var modal = document.getElementById('modal-register-freelancer');
 		var modal2 = $(".modal-dialog");
 		if (event.target == modal || event.target == modal2) {
 			$(this).css("display", "none");
 		}
 	});

 	$("#modal-criar-job").click(function(event){
 		var modal = document.getElementById('modal-criar-job');
 		if (event.target == modal) {
 			modal.style.display = "none";
 		}
 	});

 	// Pega todos os elementos da página
 	var $elemento = $("body .w3-content, .acessi-text").find("*");
 	var fonts = [];
 	var fontsMin = [];

 	// Verifica e armazena o tamanho da fonte desses elementos
 	for (var i = 0; i < $elemento.length; i++) {
 		fonts.push(parseFloat($elemento.eq(i).css('font-size')));
 		fontsMin.push(parseFloat($elemento.eq(i).css('font-size')));
 	}

	// Acessibilidade, diminui a fonte do site
	$("#diminuir-fonte").click(function(event){		
		for (var i = 0; i < $elemento.length; i++) {
			if (fonts[i] > fontsMin[i]) {
				$elemento.eq(i).css('font-size', --fonts[i]);
			}
		}
	});

	// Acessibilidade, aumenta a fonte do site
	$("#aumentar-fonte").click(function(event){
		for (var i = 0; i < $elemento.length; i++) {
			++fonts[i];
			$elemento.eq(i).css('font-size', fonts[i]);
		}
	});

	// Criar uma session com msg ao enviar formulário de contato
	$(".btn-msg-contato").click(function(event){
		if ($( ".input-contato-nome" ).val() != '' && $( ".input-contato-email" ).val() != '' && $( ".textarea-contato-msg" ).val() != '') {
			sessionStorage.setItem('contato', '1');
		}		
	});

	window.setTimeout(function() {
		// Exibe barra de mensagem, caso exista uma variavel de sessão
		var data = sessionStorage.getItem('contato');
		if (data) {    
    // Get the snackbar DIV
    var x = document.getElementsByClassName("snackbar")[0];
    // Add the "show" class to DIV
    x.className = "snackbar" + " show-snackbar";
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show-snackbar", ""); }, 4000);
    sessionStorage.removeItem('contato');
  }	
}, 800);

  // Acessibilidade, aumenta a fonte do site
  $(".publicar-empresa").click(function(event){
    console.log("Teste entrou");
    $(".form-publicar").slideToggle("slow");
  });
})