$(document).ready(function(){
	$(".link-login, .btn-login-home").click(function(event){		
			$(".link-login").toggleClass("link-active");
			$(".login-options").slideToggle('200');
	});
});