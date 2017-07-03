$(document).ready(function(){
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
});