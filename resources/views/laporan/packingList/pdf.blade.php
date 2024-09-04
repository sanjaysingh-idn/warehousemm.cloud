<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="{{ public_path('bootstrap/css/bootstrap.min.css') }}">
		<style>
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

			tr {
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
						<hr class="pt-1" style="background-color: yellow;">
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="head">
							<div class="row">
								<div class="col-12">
									<h3 class="text-center" style="margin-top: 0px !important;">
										<strong>{{ $titleReport }}</strong>
									</h3>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<p style="font-size: 14px; margin-bottom: 0px;">Periode :
										<strong>{{ \Carbon\Carbon::parse($startDate)->isoFormat('dddd, D MMMM Y') }}</strong>
									</p>

									<p>Total Pengambil : {{ $packingList->count() }} </p>
									<p>Total Pcs : {{ $packingList->count() }} </p>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-12">
									<table class="table table-hover w-100">
										<thead style="background-color: yellow; color: black;">
											<tr>
												<th>Packing List No</th>
												<th class="text-center">Jenis</th>
												<th>Nama Pengambil</th>
												<th>Barang</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($packingList as $key => $item)
												<tr>
													<td>
														{{ $item->packingListNo }}
													</td>
													<td class="text-center">
														<span
															class="
											@if ($item->jenis == 'Brocade/Tule') bg-success text-black
        									@elseif($item->jenis == 'Basic') bg-primary text-white
        									@elseif($item->jenis == 'Gent') bg-danger text-white
        									@elseif($item->jenis == 'Grosir') bg-info text-white
        									@elseif($item->jenis == 'Cabang') bg-warning text-white
        									@elseif($item->jenis == 'Ladys') bg-dark text-white @endif
											py-2 mx-2">
															<strong>{{ $item->jenis }}</strong>
														</span>
													</td>
													<td>
														{{ $item->nama_pengambil }} - (<strong>{{ $item->tujuan }}</strong>)
														<hr>
														<div class="bow">
															<div class="bol-6">
																<strong>Security</strong>
															</div>
															<div class="bol-6">
																: {{ $item->nama_security }}
															</div>
														</div>
														<div class="bow">
															<div class="bol-6">
																<strong>Koordinator</strong>
															</div>
															<div class="bol-6">
																: {{ $item->nama_koordinator }}
															</div>
														</div>
													</td>
													<td>
														@if ($item->barang)
															{!! $item->barang !!}
														@else
															<div class="col-12">
																<table class="table table-bordered">
																	<caption class="ms-4">
																		Total Pcs: {{ $item->total_pcs }} Pcs
																	</caption>
																	<thead class="bg-dark mt-5">
																		<tr>
																			<th class="text-white">Kain</th>
																			<th class="text-white">Col</th>
																			<th class="text-white">Pcs</th>
																		</tr>
																	</thead>
																	<tbody>
																		@forelse ($item->kains as $key => $kain)
																			<tr>
																				<td>{{ $kain->nama_kain }}</td>
																				<td>
																					@foreach ($kain->warnas as $warna)
																						{{ $warna->nama_warna }} <br>
																					@endforeach
																				</td>
																				<td>
																					@foreach ($kain->warnas as $warna)
																						{{ $warna->pcs->count() }} pcs <br>
																					@endforeach
																				</td>
																			</tr>
																		@empty
																			<tr>
																				<td colspan="4">No data available</td>
																			</tr>
																		@endforelse
																	</tbody>
																</table>
															</div>
														@endif
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
