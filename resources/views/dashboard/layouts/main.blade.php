<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
	data-assets-path="{{ asset('template') }}/assets/" data-template="vertical-menu-template-free">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

		<title>{{ $title }} - WMS Mac Mohan</title>

		<meta name="description" content="" />
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
		<meta name="msapplication-TileImage" content="{{ asset('template/assets/img/favicon') }}/ms-icon-144x144.png">
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

		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/libs/apex-charts/apex-charts.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

		<!-- Page CSS -->

		<!-- Helpers -->
		<script src="{{ asset('template') }}/assets/vendor/js/helpers.js"></script>

		<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
		<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
		<script src="{{ asset('template') }}/assets/js/config.js"></script>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">

		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

		{{-- Sweetalert --}}
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<style>
			.selected-user {
				display: inline-block;
				padding: 5px;
				margin: 5px;
			}

			.delete-button {
				margin-left: 10px;
				padding: 10px;
				cursor: pointer;
			}

			.box {
				padding: 10px;
				border-radius: 5px;
			}

			body {
				background-image: url({{ asset('template/assets/img/backgrounds/bg-diamond.png') }})
			}

			/* #loader {
				display: none;
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				width: 100%;
				background: rgba(0, 0, 0, 0.75) url("/your_loading_image.gif") no-repeat center center;
				z-index: 99999;
			} */
		</style>

	</head>

	<body>
		<!-- Layout wrapper -->
		<div class="layout-wrapper layout-content-navbar">
			<div class="layout-container">
				@include('dashboard.layouts.sidebar')

				<!-- Layout container -->
				<div class="layout-page">
					@include('dashboard.layouts.topbar')

					<!-- Content wrapper -->
					<div class="content-wrapper">
						<!-- Content -->

						<div class="container-xxl flex-grow-1 container-p-y">
							{{-- <div id='loader'> --}}
							@include('dashboard.layouts.toast')
							@yield('content')
							{{-- </div> --}}
						</div>
						<!-- / Content -->

						@stack('modals')
						@include('dashboard.layouts.footer')

						<div class="content-backdrop fade"></div>
					</div>
					<!-- Content wrapper -->
				</div>
				<!-- / Layout page -->
			</div>

			<!-- Overlay -->
			<div class="layout-overlay layout-menu-toggle"></div>
		</div>
		<!-- / Layout wrapper -->

		<!-- Core JS -->
		<!-- build:js assets/vendor/js/core.js -->
		{{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
			crossorigin="anonymous"></script> --}}
		{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

		<script src="{{ asset('template') }}/assets/vendor/libs/jquery/jquery.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/libs/popper/popper.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/js/bootstrap.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

		<script src="{{ asset('template') }}/assets/vendor/js/menu.js"></script>
		<!-- endbuild -->

		<!-- Vendors JS -->
		<script src="{{ asset('template') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>

		<!-- Main JS -->
		<script src="{{ asset('template') }}/assets/js/main.js"></script>

		<!-- Page JS -->
		<script src="{{ asset('template') }}/assets/js/dashboards-analytics.js"></script>

		<!-- Simple Light box for image -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
		<!-- Place this tag in your head or just before your close body tag. -->
		<script async defer src="https://buttons.github.io/buttons.js"></script>
		<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
		<script src="{{ asset('template') }}/assets/js/sortable.js"></script>
		<script>
			@if (session('message'))
				Swal.fire({
					title: 'Success!',
					text: '{{ session('message') }}',
					icon: 'success',
					confirmButtonText: 'OK'
				});
			@endif
			@if (session('message_delete'))
				Swal.fire({
					title: 'Success!',
					text: '{{ session('message_delete') }}',
					icon: 'success',
					confirmButtonText: 'OK'
				});
			@endif
			@if (session('message_failed'))
				Swal.fire({
					title: 'Failed!',
					text: '{{ session('message_failed') }}',
					icon: 'failed',
					confirmButtonText: 'OK'
				});
			@endif
		</script>
		{{-- <script>
			document.addEventListener("DOMContentLoaded", function() {
				// Show loading spinner
				Swal.fire({
					title: 'Loading...',
					text: 'Please wait',
					allowOutsideClick: false,
					showCancelButton: false,
					showConfirmButton: false,
					onBeforeOpen: () => {
						Swal.showLoading();
					},
					onAfterClose: () => {
						// Content is ready, you can open the loader now
						Swal.fire('Content Loaded!', '', 'success');
					}
				});

				// Content is ready to be loaded
				// Perform your initialization or load content here

				// Close the SweetAlert loader when your content is ready
				Swal.close();
			});
		</script> --}}
		@stack('scripts')
	</body>

</html>
