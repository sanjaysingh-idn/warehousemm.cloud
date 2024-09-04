<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="{{ public_path('bootstrap/css/bootstrap.min.css') }}">
		<style>
			.bow {
				clear: both;
			}

			.bol-1 {
				width: 8%;
				float: left;
			}

			.bol-2 {
				width: 16%;
				float: left;
			}

			.bol-3 {
				width: 25%;
				float: left;
			}

			.bol-4 {
				width: 33%;
				float: left;
			}

			.bol-5 {
				width: 42%;
				float: left;
			}

			.bol-6 {
				width: 50%;
				float: left;
			}

			.bol-7 {
				width: 58%;
				float: left;
			}

			.bol-8 {
				width: 66%;
				float: left;
			}

			.bol-9 {
				width: 75%;
				float: left;
			}

			.bol-10 {
				width: 83%;
				float: left;
			}

			.bol-11 {
				width: 92%;
				float: left;
			}

			.bol-12 {
				width: 100%;
				float: left;
			}

			.row {
				display: -webkit-box;
				display: -webkit-flex;
				display: flex;
			}

			.row>div {
				-webkit-box-flex: 1;
				-webkit-flex: 1;
			}

			.fs-me {
				font-size: 0.7rem;
			}

			#my-table {
				border-color: white !important;
			}

			#my-table th td {
				border-color: white !important;
			}

			.text-center {
				text-align: center !important;
			}

			table {
				border-collapse: collapse;
				width: 100%;
			}

			th,
			td {
				border: 1px solid #dddddd;
				text-align: left;
				padding: 8px;
			}

			td {
				page-break-inside: avoid;
			}

			footer {
				position: fixed;
				bottom: -30px;
				left: 0px;
				right: 0px;
				height: 60px;
				font-size: 18px !important;
				color: black !important;
				/** Extra personal styles **/
				text-align: center;
				line-height: 35px;
				opacity: 0.5;
			}
		</style>
		<title>{{ $title }}</title>
	</head>

	<body>
		<footer style="font-size: 10px">
			Warehouse Management System <strong>Mac Mohan Surakarta</strong> ©
			<script>
				document.write(new Date().getFullYear());
			</script>
		</footer>
		<main>
			<div class="">
				<div class="row">
					<div class="col-12 text-center">
						<img src="{{ public_path('image/logo.png') }}" alt="" srcset="" style="width: 80px"
							class="text-center mb-1">
						<h3>Mac Mohan Warehouse</h3>
						<p style="font-size: 14px">Jl. Gatot Subroto No.42, Kemlayan, Kec. Serengan, Kota Surakarta, Jawa Tengah 57151</p>
						<hr>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="head">
							<div class="row">
								<div class="col-12">
									<h3 class="text-center" style="margin-top: 0px !important;">
										<strong>{{ $namaKain }}</strong>
									</h3>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									{{-- <p style="font-size: 14px; margin-bottom: 0px;">Periode :
										<strong>{{ \Carbon\Carbon::parse($startDate)->isoFormat('dddd, D MMMM Y') }}</strong>
									</p> --}}

									{{-- <strong>{{ \Carbon\Carbon::parse($endDate)->isoFormat('dddd, D MMMM Y') }}</strong> --}}
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<table class="table table-hover w-100">
										<thead style="background-color: yellow; color: black;">
											<tr>
												<th>No</th>
												<th>Nama Kain</th>
												<th>Warna</th>
											</tr>
										</thead>
										<tbody>
											@php
												$no = 1;
											@endphp
											@foreach ($kainReport as $item)
												<tr class="align-top">
													<td>{{ $no++ }}</td>
													<td>
														{{-- Name of the Kain --}}
														<strong>{{ $item->nama_kain }}</strong>
														@if ($item->kode_desain)
															<br><strong>{{ $item->kode_desain }}</strong>
														@endif
														@if ($item->lot)
															<br>Lot: <strong>{{ $item->lot }}</strong>
														@endif
														<br>
														@if ($item->foto_kain)
															<div class="p-2">
																<?php
																$imagePath = public_path('storage/' . $item->foto_kain);
																$imageData = base64_encode(file_get_contents($imagePath));
																$imageMimeType = mime_content_type($imagePath);
																$base64Image = 'data:' . $imageMimeType . ';base64,' . $imageData;
																?>
																<img src="{{ $base64Image }}" class="img-fluid rounded-top" width="200"
																	alt="{{ $item->nama_kain }}">
															</div>
															<br>
														@endif
													</td>

													<td>
														<table class="table table-hover w-100 mt-2">
															<thead style="background-color: yellow; color: black;">
																<tr>
																	<th>Desain || Warna</th>
																	<th>Pcs Ready</th>
																	<th>Yard</th>
																</tr>
															</thead>
															<tbody>
																@foreach ($item->warnas->sortBy('nama_warna') as $warna)
																	<tr class="align-top @if ($warna->total_ready_pcs == 0) bg-success @endif">
																		<td>
																			{{ $warna->nama_warna }}
																			<br>
																			<span class="badge bg-primary">{{ $warna->nama_desain }}</span>
																		</td>
																		<td>
																			{{ $warna->total_ready_pcs }} Pcs
																		</td>
																		<td>
																			<div>
																				@foreach ($warna->pcs as $pcs)
																					<span class="square p-1 shadow mx-auto text-center">
																						{{ $pcs->yard }}
																					</span>
																				@endforeach
																			</div>
																		</td>
																	</tr>
																@endforeach
															</tbody>
														</table>
														<br>
														<strong>Pcs Total: {{ $item->warnas->sum('total_ready_pcs') }}</strong>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</body>

</html>
