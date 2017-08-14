$(document).ready(function(){
	$(".overlay").css({ display: "block" });
	$("#cnpj").mask('00.000.000/0000-00', {reverse: true});
	$("#cep").mask('00000-000');

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

	$(".overlay").click(function(event){
		$(this).css({display: "none"});
	});
})