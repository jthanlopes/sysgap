$(document).ready(function(){
	// Exibe overlay ao abrir a home-page
	$(".overlay").css({ display: "block" });
	// Acrescenta a animação ao overlay
	$('.animate-zoomIn').addClass('animated zoomIn');
	$('.animate-slideInLeft').addClass('animated slideInLeft');	

  // Aplica a maskara de campos aos inputs
  $("#cnpj").mask('00.000.000/0000-00', {reverse: true});
  $("#cep").mask('00000-000');

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
			console.log("Entrou");
			$(this).css("display", "none");			
		}
	});

	$("#modal-criar-job").click(function(event){
		var modal = document.getElementById('modal-criar-job');
		if (event.target == modal) {
			modal.style.display = "none";
		}
	});

	// Fecha overlay da home ao clicar nele
	$(".overlay").click(function(event){
		$(this).css({display: "none"});		
		$('.animate-fadeIn').addClass('animated fadeIn');
	});
})