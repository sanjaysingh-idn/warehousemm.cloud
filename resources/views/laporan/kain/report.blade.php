@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold">
			<span class="text-muted fw-light py-5"></span>
			{{ $title }}
		</h2>
		<div class="col-6 mb-3">
			<a href="/laporanKain" class="btn btn-secondary"><i class="bx bx-left-arrow-circle"></i> Kembali</a>
		</div>
		<div class="col-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="text-start">
						Laporan Data Kain
						<br>
						<strong>{{ date('j F Y', strtotime($startDate)) }}</strong> -
						<strong>{{ date('j F Y', strtotime($endDate)) }}</strong>
						<hr>
					</div>
				</div>
				<div class="card-body mt-0">
					<div class="text-start">
						<a href="{{ route('generate-kain-pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
							class="btn btn-primary" target="_blank">
							<i class="bx bxs-file-pdf"></i> Cetak PDF
						</a>
						<hr>
					</div>
					<table class="table table-hover w-100" id="table">
						<caption class="ms-4">
							Total Data : {{ $kainReport->count() }}
						</caption>
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Kain</th>
								<th>Inpu Pada</th>
								<th>Supplier</th>
								<th>Lokasi</th>
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
										{{ $item->nama_kain }}
										<br><strong>{{ $item->kode_desain }} </strong>
									</td>
									<td>{{ date('j F Y', strtotime($item->input_at)) }}</td>
									<td>{{ $item->supplier->kode_supplier }}</td>
									<td>{{ $item->lokasi }}</td>
									<td>
										<div class="mb-3" style="column-count: 2 !important;">
											<table class="table table-bordered" style="width: 100%;">
												<tbody>
													@foreach ($item->warnas->sortBy(function ($warna) {
									return strlen($warna->nama_warna);
					}) as $warna)
														<tr>
															<td>
																<strong>{{ $warna->nama_warna }}:</strong>
															</td>
															<td>
																{{ $warna->total_pcs }} Pcs
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
											@php
												$totalPcsKain = 0;
												$totalYardKain = 0;
											@endphp
											@foreach ($item->warnas as $w)
												@php
													$totalPcsKain += $w->total_pcs;
													$totalYardKain += $w->pcs->sum('yard');
												@endphp
											@endforeach
										</div>
										<strong><span class="bg-primary text-white p-2">Total Pcs: {{ $totalPcsKain }}</span></strong>
										<br>
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
{{-- @php
													$totalYard = 0;
													$sortedPcs = $warna->pcs->sortBy('yard');
												@endphp
												@foreach ($sortedPcs as $pcs)
													<span class="border border-2 p-1 me-1 my-1">
														{{ $pcs->yard }}
													</span>
													@php
														$totalPcsKain += 1;
														$totalYardKain += $pcs->yard;
														$totalYard += $pcs->yard;
													@endphp
												@endforeach --}}
@push('scripts')
	<script>
		$(document).ready(function() {
			$('#table').DataTable({
				responsive: true,
				dom: 'Brtip', // Include 'B' for buttons in 'dom'
				buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
			});
		});

		'use strict';

		function clearForm() {
			// Reset the form fields to their default values
			document.getElementById('reportForm').reset();
		}
	</script>
@endpush
