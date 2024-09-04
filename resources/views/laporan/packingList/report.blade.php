@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold">
			<span class="text-muted fw-light py-5"></span>
			{{ $title }}
		</h2>
		<div class="col-6 mb-3">
			<a href="/laporanPackingList" class="btn btn-secondary"><i class="bx bx-left-arrow-circle"></i> Kembali</a>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="text-start">
						Laporan Packing List
						<br>
						<strong>{{ date('j F Y', strtotime($startDate)) }}</strong> -
						<strong>{{ date('j F Y', strtotime($endDate)) }}</strong>
						<hr>
					</div>
				</div>
				<div class="card-body mt-0">
					<div class="text-start">
						<a href="{{ route('generate-packcingList-pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
							class="btn btn-primary" target="_blank">
							<i class="bx bxs-file-pdf"></i> Cetak PDF
						</a>
						<hr>
					</div>
					<table id="table" class="table table-hover w-100" style="width: 100% !important;">
						<caption class="ms-4">
							Total Kain Keluar : {{ $packingList->count() }}
						</caption>
						<thead>
							<tr class="bg-dark">
								<th class="text-white">Packing List No</th>
								<th class="text-white">Jenis</th>
								<th class="text-white">Tanggal</th>
								<th class="text-white">Nama Pengambil</th>
								<th class="text-white">Tujuan</th>
								<th class="text-white">Mengetahui</th>
								<th class="text-white">Barang</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($packingList as $key => $item)
								<tr>
									<td>
										{{ $item->packingListNo }}
									</td>
									<td>
										<span
											class="
											@if ($item->jenis == 'Brocade/Tule') bg-success text-black
        									@elseif($item->jenis == 'Basic') bg-primary text-white
        									@elseif($item->jenis == 'Gent') bg-danger text-white
        									@elseif($item->jenis == 'Ladys') bg-dark text-white @endif
											p-2">
											<strong>{{ $item->jenis }}</strong>
										</span>
									</td>
									<td>
										{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D/M/Y') }}
									</td>
									<td>
										{{ $item->nama_pengambil }}
									</td>
									<td>
										<strong>{{ $item->tujuan }}</strong>
									</td>
									<td>
										<strong>Security</strong> : {{ $item->nama_security }} <br>
										<strong>Koordinator</strong> : {{ $item->nama_koordinator }}
									</td>
									<td width="30%">
										@if ($item->barang)
											{!! $item->barang !!}
										@else
											<div class="col-12">
												<div class="my-2">

													<table class="table table-bordered">
														<caption class="ms-4">
															Total Pcs: {{ $item->total_pcs }} Pcs
														</caption>
														<thead class="bg-warning mt-5">
															<tr>
																<th class="text-white">Kain</th>
																<th class="text-white">Col</th>
																<th class="text-white">Pcs</th>
															</tr>
														</thead>
														<tbody>
															@forelse ($item->kains as $kain)
																{{-- Group Kain items --}}
																@php
																	$firstWarna = $kain->warnas->first();
																@endphp
																<tr>
																	<td rowspan="{{ $kain->warnas->count() }}">{{ $kain->nama_kain }}</td>
																	<td>{{ $firstWarna->nama_warna }}</td>
																	<td>{{ $firstWarna->pcs->count() }} pcs</td>
																</tr>
																@foreach ($kain->warnas->slice(1) as $warna)
																	<tr>
																		<td>{{ $warna->nama_warna }}</td>
																		<td>{{ $warna->pcs->count() }} pcs</td>
																	</tr>
																@endforeach
															@empty
																<tr>
																	<td colspan="3">No data available</td>
																</tr>
															@endforelse
														</tbody>
													</table>

												</div>
											</div>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
				</div>
				</form>
			</div>
		</div>
	</div>
	<!--/ User Profile Content -->
@endsection

@push('scripts')
	<script>
		$(document).ready(function() {
			$('#table').DataTable({
				// "dom": 'rtip',
				responsive: true,
				order: [
					[1, "desc"]
				]
			});
		});

		'use strict';

		function clearForm() {
			// Reset the form fields to their default values
			document.getElementById('reportForm').reset();
		}
	</script>
@endpush
