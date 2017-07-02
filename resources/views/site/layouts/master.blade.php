<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<title>Document</title>	
	<link rel="stylesheet" href="/site-assets/css/style.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
	{{-- Icones Google --}}
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>	
	@include ('site.layouts.header')
	@include ('site.layouts.carousel')
	@yield ('conteudo')
	@include ('site.layouts.footer')
	@include ('site.layouts.scripts')