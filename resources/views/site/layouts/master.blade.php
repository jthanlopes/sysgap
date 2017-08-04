<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<title>Document</title>	
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
				<h2>Clique para continuar.</h2>
			</div>
		</div>
		@include ('site.layouts.header-home')
		@include ('site.layouts.carousel')
		@yield ('conteudo')
		{{-- @include ('site.layouts.footer') --}}
		@include ('site.layouts.scripts')
	</div>