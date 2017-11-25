<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<title>Home Page SysGAP</title>
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	{{-- Bootstrap --}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	{{-- Fonts Google e CloudFlare --}}
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	{{-- Icones Google --}}
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	{{-- Animate.css --}}
	<link rel="stylesheet" href="/site-assets/css/animate.css">

	{{-- Css Home --}}
	<link rel="stylesheet" href="/site-assets/css/home.css">

	{{-- Css Geral --}}
	<link rel="stylesheet" href="/site-assets/css/style.css" />
</head>
<body>
		@include ('site.layouts.home.nav-home')
		@yield ('conteudo')
		{{-- @include ('site.layouts.footer') --}}
		@include ('site.layouts.home.scripts')
		@include ('site.layouts.home.footer')

	{{-- <script> --}}

	{{-- // 	['response' => true, 'message'=> 'item salvo com sucesso!']

	// 	return response()->json(['response' => true, 'message'=> 'item salvo com sucesso!']);


	// 	$( ".formulario" ).on( "submit", function( event ) {
	// 		event.preventDefault();
	// 		var formulario = $( this ).serialize();

	// 		$.ajax({

	// 			type: 'post',
	// 			url: formulario.route,
	// 			data: {
	// 				'data': formulario
	// 			},
	// 			success: function (data){


	// 			}, error(function() {
	// 				/* Act on the event */
	// 			});

	// 		})
	// 	}); --}}
{{-- </script> --}}
