<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>{{ $title }} - WMS Mac Mohan</title>

		<style>
			/* Flexbox container for horizontal layout */
			.flex-container {
				display: flex;
				flex-wrap: wrap;
				/* Ensure items wrap when they reach the end of the row */
				justify-content: space-between;
				/* Add spacing between items */
				gap: 10px;
				/* Space between items */
				padding: 10px;
				box-sizing: border-box;
			}

			/* Each flex item */
			.flex-item {
				width: 48%;
				/* Two items per row */
				padding: 10px;
				border: 1px solid #ddd;
				border-radius: 5px;
				box-sizing: border-box;
			}

			/* Flex styling for items inside */
			.pcs-item {
				display: flex;
				margin-bottom: 5px;
				align-items: center;
			}

			.pcs-qrcode {
				margin-right: 20px;
			}

			/* Print styling */
			@media print {
				body {
					width: 210mm;
					height: 297mm;
					margin: 0;
					padding: 10mm;
					box-sizing: border-box;
				}

				.flex-item {
					page-break-inside: avoid;
					width: 48%;
				}

				@page {
					size: A4;
					margin: 10mm;
				}
			}

			.pcs-item {
				padding: 10px;
				border: 1px solid #ddd;
				margin-bottom: 10px;
				border-radius: 5px;
				display: flex;
				align-items: center;
			}

			/* Style for items with null status */
			.pcs-item.empty-status {
				background-color: #ff0000;
				/* Light red background for null status */
				border-color: #ff0000;
				/* Red border for visibility */
			}
		</style>
	</head>

	<body>
		<h2>{{ $kain->nama_kain }}</h2>

		<div class="flex-container">
			@php
				$sortedWarnas = $kain->warnas->sortBy(function ($item) {
				    return intval(preg_replace('/[^0-9]+/', '', $item->nama_warna));
				});
			@endphp

			@foreach ($sortedWarnas as $item)
				@if ($item->total_ready_pcs > 0)
					<!-- Only show if total_ready_pcs is greater than 0 -->
					<div class="flex-item">
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
					</div>
				@endif
			@endforeach

		</div>
	</body>

</html>
