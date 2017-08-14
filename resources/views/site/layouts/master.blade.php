<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<title>Document</title>	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="/site-assets/css/style.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	{{-- Icones Google --}}
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	{{-- Bower_components --}}	
	<link href="/bower_resources/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />  
</head>
<body>	
	<div id="home-page" class="container-fluid">
		<div class="overlay" onclick="off()">
			<div class="msg-alerta">
				<h1>Página em desenvolvimento.</h1>
				<h3>clique para continuar</h3>
				{{-- <form class="formulario">
					<input type="hidden" name="route" value="{{ route('home.create') }}">
					<input type="text" name="nome" id="Rodrigo">
					<button class="btn-submit" type="button">Enviar</button>
				</form> --}}
			</div>
		</div>
		@include ('site.layouts.header-home')
		@include ('site.layouts.carousel')
		@yield ('conteudo')
		{{-- @include ('site.layouts.footer') --}}
		@include ('site.layouts.scripts')
	</div>

	<script>

	['response' => true, 'message'=> 'item salvo com sucesso!']
		
		return response()->json(['response' => true, 'message'=> 'item salvo com sucesso!']);
		

		$( ".formulario" ).on( "submit", function( event ) {
		  event.preventDefault();
		  var formulario = $( this ).serialize();

		  $.ajax({

		  	type: 'post',
		  	url: formulario.route,
		  	data: {
		  		'data': formulario
		  	},
		  	success: function (data){
		  		

		  	}, error(function() {
		  		/* Act on the event */
		  	});

		  })
		});

	</script>