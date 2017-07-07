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
})

// Pegar Modal
var modal = document.getElementById('modal-login-empresa');
var modal2 = document.getElementById('modal-login-freelancer');

// Fechar Modal ao clicar fora dele
window.onclick = function(event) {
    if (event.target == modal || event.target == modal2) {
        modal.style.display = "none";
        modal2.style.display = "none";
    }
}