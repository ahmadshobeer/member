<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset(' img/icons/icon-48x48.png') }}" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Auth {{config('app.name')}}</title>

	{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
	<link class="js-stylesheet" href="{{ asset('css/light.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
        @yield('content')
	</main>

	<script src=" {{ asset('js/app.js') }} "></script>

</body>

</html>