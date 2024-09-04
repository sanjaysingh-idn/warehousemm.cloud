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

			.square {
				width: 15px;
				height: 15px;
				border: 1px solid #000;
				margin-top: 2px;
			}

			.indent {
				margin-left: 20px;
				/* Adjust the value based on your preference */
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
							<div class="row mb-0">
								<div class="col-12">
									<h3 class="text-center" style="margin-top: 0px !important;">
										<strong>{{ $titleReport }}</strong>
									</h3>
									<h4
										class="@if ($packingList->jenis == 'Brocade/Tule') p-1 bg-success text-black fw-bold
        									@elseif($packingList->jenis == 'Basic') p-1 bg-primary text-white fw-bold
        									@elseif($packingList->jenis == 'Gent') p-1 bg-danger text-white fw-bold
        									@elseif($packingList->jenis == 'Grosir') p-1 bg-info text-white fw-bold
        									@elseif($packingList->jenis == 'Cabang') p-1 bg-warning text-white fw-bold
        									@elseif($packingList->jenis == 'Ladys') p-1 bg-dark text-white fw-bold @endif">
										{{ $packingList->jenis }}
									</h4>
								</div>
							</div>
							<div class="bow">
								<div class="bol-2">
									<strong>Tanggal</strong>
								</div>
								<div class="bol-4">
									: {{ \Carbon\Carbon::parse($packingList->tanggal)->isoFormat('D MMMM Y') }}
								</div>
							</div>
							<div class="bow">
								<div class="bol-2">
									<strong>PL No</strong>
								</div>
								<div class="bol-4">
									: {{ $packingList->packingListNo }}
								</div>
							</div>
							<div class="bow">
								<div class="bol-2">
									<strong><strong>Diambil Oleh</strong></strong>
								</div>
								<div class="bol-4">
									: {{ $packingList->nama_pengambil }}
								</div>
							</div>
							<div class="bow">
								<div class="bol-2">
									<strong>Tujuan</strong>
								</div>
								<div class="bol-4">
									: {{ $packingList->tujuan }}
								</div>
							</div>
							<div class="row mt-3">
								@if ($packingList->barang)
									<hr>
									<div class="col-12 mt-3">
										{!! $packingList->barang !!}
									</div>
								@else
									<hr>
									<div class="col-12">
										<table id="table" class="table table-hover w-100" style="width: 100% !important;">
											<caption class="ms-4">
												Total Pcs: {{ $packingList->total_pcs }} Pcs
											</caption>
											<thead class="bg-dark mt-5">
												<tr>
													{{-- <th>Foto Kain</th> --}}
													<th class="text-white text-center">No</th>
													<th class="text-white">Nama Kain</th>
													<th class="text-white text-center">Color</th>
													<th class="text-white">Pcs</th>
													<th class="text-white">Yard</th>
												</tr>
											</thead>
											<tbody>
												@forelse ($packingList->kains as $key => $kain)
													<tr>
														<td class="text-center">{{ $key + 1 }}</td>
														<td>
															{{ $kain->nama_kain }}
															@if ($kain->nama_desain !== '-' || $kain->nama_desain !== null)
																<br>
																<span class="badge bg-primary">{{ $kain->nama_desain }}</span>
															@endif
														</td>
														<td class="text-center">
															@foreach ($kain->warnas as $warna)
																{{ $warna->nama_warna }} <br>
															@endforeach
														</td>
														<td>
															@foreach ($kain->warnas as $warna)
																{{ $warna->pcs->count() }} pcs <br>
															@endforeach
														</td>

														<td>
															@foreach ($kain->warnas as $warna)
																@foreach ($warna->pcs as $pcs)
																	<span class="square p-1 text-center">
																		{{ $pcs->yard }}
																	</span>
																@endforeach
																<br>
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
							</div>
							<div class="bow">
								<hr>
								<div class="bol-6 text-center">
									<strong>Nama Security</strong>
									<br>
									{{ $packingList->nama_security }}
								</div>
								<div class="bol-6 text-center">
									<strong>Nama Koordinator</strong>
									<br>
									{{ $packingList->nama_koordinator }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</body>

</html>
