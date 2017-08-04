$(document).ready(function(){
	$(".overlay").css({ display: "block" });

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