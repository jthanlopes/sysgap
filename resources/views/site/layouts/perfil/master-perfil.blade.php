<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<title>SysGAP - Perfil</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	{{-- Icones Google --}}
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	{{-- Bower_components --}}
	<link href="/bower_resources/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
	{{-- Css Home --}}
	<link rel="stylesheet" href="/site-assets/css/perfil.css">
	{{-- Css Geral --}}
	<link rel="stylesheet" href="/site-assets/css/style.css" />
	{{-- Css W3C --}}
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif;}
	</style>
</head>
<body class="w3-theme-l5">
	@include ('site.layouts.perfil.nav-perfil')
	@if (auth()->guard('empresa')->check())
	@include ('site.layouts.perfil.aside-left')
	@else
	@include ('site.layouts.perfil.aside-left-freelancer')
	@endif
	@yield ('conteudo')
	@include ('site.layouts.perfil.aside-right')
	<!-- Snackbar cadastro de Job -->
	{{-- <div class="snackbar">Job cadastrado com sucesso.</div> --}}
	@include ('site.layouts.perfil.footer')
	@include ('site.layouts.perfil.scripts')
