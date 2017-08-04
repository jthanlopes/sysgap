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
	<div id="admin-perfil" class="container-fluid">
		@include ('site.layouts.header-perfil')	
		@yield ('conteudo')
		<!-- The actual snackbar -->
		<div class="snackbar">Job cadastrado com sucesso.</div>
		{{-- @include ('site.layouts.footer') --}}
		@include ('site.layouts.scripts')
	</div>