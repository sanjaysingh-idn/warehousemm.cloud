<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style customizer-hide" dir="ltr"
	data-theme="theme-default" data-assets-path="{{ asset('template') }}/assets/" data-template="vertical-menu-template-free">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

		<title>WMS Mac Mohan</title>

		<meta name="description" content="" />
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Favicon -->
		<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('template/assets/img/favicon') }}/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('template/assets/img/favicon') }}/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('template/assets/img/favicon') }}/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template/assets/img/favicon') }}/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('template/assets/img/favicon') }}/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('template/assets/img/favicon') }}/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('template/assets/img/favicon') }}/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152"
			href="{{ asset('template/assets/img/favicon') }}/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180"
			href="{{ asset('template/assets/img/favicon') }}/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"
			href="{{ asset('template/assets/img/favicon') }}/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32"
			href="{{ asset('template/assets/img/favicon') }}/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96"
			href="{{ asset('template/assets/img/favicon') }}/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16"
			href="{{ asset('template/assets/img/favicon') }}/favicon-16x16.png">
		<link rel="manifest" href="{{ asset('template/assets/img/favicon') }}/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
			rel="stylesheet" />

		<!-- Icons. Uncomment required icon fonts -->
		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/fonts/boxicons.css" />

		<!-- Core CSS -->
		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/css/core.css"
			class="template-customizer-core-css" />
		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/css/theme-default.css"
			class="template-customizer-theme-css" />
		<link rel="stylesheet" href="{{ asset('template') }}/assets/css/demo.css" />

		<!-- Vendors CSS -->
		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

		<!-- Page CSS -->
		<!-- Page -->
		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/css/pages/page-auth.css" />
		<!-- Helpers -->
		<script src="{{ asset('template') }}/assets/vendor/js/helpers.js"></script>

		<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
		<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
		<script src="{{ asset('template') }}/assets/js/config.js"></script>
	</head>

	<body>
		<!-- Not Authorized -->
		<div class="container-xxl container-p-y text-center">
			<div class="misc-wrapper">
				<h2 class="mb-2 mx-2">You are not authorized!</h2>
				<p class="mb-4 mx-2">You do not have permission to view this page using the credentials that you have provided while
					login. <br></p>
				<a href="/" class="btn btn-primary">Back to home</a>
				<div class="mt-5">
					<img src="{{ 'template' }}/assets/img/illustrations/page-misc-error-light.png"
						alt="page-misc-not-authorized-light" width="450" class="img-fluid"
						data-app-light-img="illustrations/page-misc-error-light.png"
						data-app-dark-img="illustrations/page-misc-error-light.png">
				</div>
			</div>
		</div>
		<!-- /Not Authorized -->

		<!-- Core JS -->
		<!-- build:js assets/vendor/js/core.js -->
		<script src="{{ asset('template') }}/assets/vendor/libs/jquery/jquery.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/libs/popper/popper.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/js/bootstrap.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

		<script src="{{ asset('template') }}/assets/vendor/js/menu.js"></script>
		<!-- endbuild -->

		<!-- Vendors JS -->

		<!-- Main JS -->
		<script src="{{ asset('template') }}/assets/js/main.js"></script>

		<!-- Page JS -->
		<script src="{{ asset('template') }}/assets/js/ui-toasts.js"></script>

		<!-- Place this tag in your head or just before your close body tag. -->
		<script async defer src="https://buttons.github.io/buttons.js"></script>
	</body>

</html>
