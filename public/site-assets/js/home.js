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

  // Acessibilidade, aumenta a fonte do site
  $(".publicar-empresa").click(function(event){
    $(".form-publicar").slideToggle("slow");
  });
  // Acessibilidade, aumenta a fonte do site
  $(".opcoes-pesquisa").click(function(event){
    $(".show-opcoes-pesquisa").slideToggle("slow");
  });
});