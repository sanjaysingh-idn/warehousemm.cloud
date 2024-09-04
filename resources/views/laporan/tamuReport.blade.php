@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold">
			<span class="text-muted fw-light py-5"></span>
			{{ $title }}
		</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="text-start">
						Laporan Data tamu hari
						<br>
						<strong>{{ date('j F Y', strtotime($startDate)) }}</strong> -
						<strong>{{ date('j F Y', strtotime($endDate)) }}</strong>
						<hr>
					</div>
				</div>
				<div class="card-body mt-0">
					<div class="text-start">
						<a href="{{ route('generate-tamu-pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
							class="btn btn-primary" target="_blank">
							<i class="bx bxs-file-pdf"></i> Cetak PDF
						</a>
						<hr>
					</div>
					<table class="table table-hover w-100">
						<caption class="ms-4">
							Total Tamu : {{ $tamuReport->count() }} Orang
						</caption>
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Hari/Tgl</th>
								<th>Jam Masuk/Keluar</th>
								<th>Keperluan</th>
							</tr>
						</thead>
						<tbody>
							@php
								$no = 1;
							@endphp
							@foreach ($tamuReport as $item)
								<tr>
									<td>{{ $no++ }}</td>
									<td>{{ $item->nama }}</td>
									<td>{{ \Carbon\Carbon::parse($item->hari)->isoFormat('dddd, D MMMM Y') }}</td>
									<td>{{ date('H:i', strtotime($item->jam_masuk)) }} WIB - {{ date('H:i', strtotime($item->jam_keluar)) }} WIB
									</td>
									<td>{{ $item->keperluan }}</td>
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
