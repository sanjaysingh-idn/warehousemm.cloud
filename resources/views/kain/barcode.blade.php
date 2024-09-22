<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>{{ $title }} - WMS Mac Mohan</title>

		<style>
			/* Basic table styling */
			table {
				width: 100%;
				border-collapse: collapse;
			}

			/* Table cells styling */
			td {
				width: 50%;
				vertical-align: top;
				padding: 10px;
				box-sizing: border-box;
			}

			/* QR code and text layout inside each flex-item */
			.pcs-item {
				display: flex;
				align-items: center;
				margin-bottom: 10px;
				border: 1px solid #ddd;
				border-radius: 5px;
				padding: 10px;
			}

			.pcs-qrcode {
				margin-right: 20px;
			}

			/* Print-specific styling */
			@media print {
				@page {
					size: A4;
					margin: 10mm;
				}

				td {
					page-break-inside: avoid;
					/* Ensure each column item doesn't break */
				}

				/* Prevent page break after h2 */
				h2 {
					page-break-after: avoid;
				}
			}
		</style>
	</head>

	<body>
		<!-- Adding margin-bottom to push content closer to the title -->
		<h2 style="margin-bottom: 10px;">{{ $kain->nama_kain }}</h2>

		@php
			$sortedWarnas = $kain->warnas->sortBy(function ($item) {
			    return intval(preg_replace('/[^0-9]+/', '', $item->nama_warna));
			});

			// Split warnas into two groups for left and right columns
			$half = ceil($sortedWarnas->count() / 2);
			$leftColumn = $sortedWarnas->slice(0, $half);
			$rightColumn = $sortedWarnas->slice($half);
		@endphp

		<!-- Table for two columns layout -->
		<table>
			<tr>
				<td>
					<!-- Left Column Content -->
					@foreach ($leftColumn as $item)
						@if ($item->total_ready_pcs > 0)
							<strong>{{ $item->nama_warna }}</strong><br>
							<span>{{ $item->total_ready_pcs }} Pcs Ready</span><br>

							<div class="warna-pcs">
								@foreach ($item->pcs as $pcs)
									@if (is_null($pcs->status))
										<!-- Show only pcs with null status -->
										@php
											$qrCodeData =
											    "\nID Kain: " .
											    $kain->id .
											    '-' .
											    $kain->supplier->nama_supplier .
											    "\nNama Kain: " .
											    $kain->nama_kain .
											    "\nKode Desain: " .
											    $kain->kode_desain .
											    "\nWarna: " .
											    $item->nama_warna .
											    "\nYard: " .
											    $pcs->yard;
										@endphp

										<div class="pcs-item">
											<div class="pcs-qrcode">
												{!! QrCode::size(100)->generate($qrCodeData) !!}
											</div>
											<div>
												<div><strong>{{ $kain->nama_kain }}</strong></div>
												<div>{{ $kain->kode_desain }}</div>
												<div>Col: {{ $item->nama_warna }}</div>
												<div>Yard: {{ $pcs->yard }}</div>
											</div>
										</div>
									@endif
								@endforeach
							</div>
						@endif
					@endforeach
				</td>

				<td>
					<!-- Right Column Content -->
					@foreach ($rightColumn as $item)
						@if ($item->total_ready_pcs > 0)
							<strong>{{ $item->nama_warna }}</strong><br>
							<span>{{ $item->total_ready_pcs }} Pcs Ready</span><br>

							<div class="warna-pcs">
								@foreach ($item->pcs as $pcs)
									@if (is_null($pcs->status))
										<!-- Show only pcs with null status -->
										@php
											$qrCodeData =
											    "\nID Kain: " .
											    $kain->id .
											    '-' .
											    $kain->supplier->nama_supplier .
											    "\nNama Kain: " .
											    $kain->nama_kain .
											    "\nKode Desain: " .
											    $kain->kode_desain .
											    "\nWarna: " .
											    $item->nama_warna .
											    "\nYard: " .
											    $pcs->yard;
										@endphp

										<div class="pcs-item">
											<div class="pcs-qrcode">
												{!! QrCode::size(100)->generate($qrCodeData) !!}
											</div>
											<div>
												<div><strong>{{ $kain->nama_kain }}</strong></div>
												<div>{{ $kain->kode_desain }}</div>
												<div>Col: {{ $item->nama_warna }}</div>
												<div>Yard: {{ $pcs->yard }}</div>
											</div>
										</div>
									@endif
								@endforeach
							</div>
						@endif
					@endforeach
				</td>
			</tr>
		</table>
	</body>

</html>
