@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold">
			<span class="text-muted fw-light py-5"></span>
			{{ $title }}
		</h2>
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						Formulir cetak Laporan Data Tamu
						<hr>
					</div>
				</div>
				<div class="card-body">
					<div class="alert alert-primary" role="alert">
						Pilih <strong>Tanggal Mulai</strong> dan <strong>Tanggal Selesai</strong>
					</div>
					<form action="{{ route('laporanTamu.generate-report-tamu') }}" method="post" id="reportForm">
						@csrf
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="start_date" class="form-label">Tanggal Mulai</label>
								<input class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date"
									name="start_date" value="{{ old('start_date') }}" max="{{ date('Y-m-d') }}" />
								@error('start_date')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="end_date" class="form-label">Tanggal Selesai</label>
								<input class="form-control @error('end_date') is-invalid @enderror" type="date" id="end_date" name="end_date"
									value="{{ old('end_date') }}" max="{{ date('Y-m-d') }}" />
								@error('end_date')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="clearForm()">
						Clear Form
					</button>
					<button type="submit" class="btn btn-primary ms-2"><i class="bx bxs-report"></i> Submit</button>
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
