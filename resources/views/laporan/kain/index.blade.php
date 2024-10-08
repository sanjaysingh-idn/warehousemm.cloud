@extends('dashboard.layouts.main')

@section('content')
	<div class="row mb-3">
		<div class="col-6">
			<h2 class="fw-bold">
				<span class="text-muted fw-light py-5"></span>
				{{ $title }}
			</h2>
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						Formulir cetak Laporan Kain Masuk
						<hr>
					</div>
				</div>
				<div class="card-body">
					<div class="alert alert-primary" role="alert">
						Pilih <strong>Tanggal Mulai</strong> dan <strong>Tanggal Selesai</strong>
					</div>
					<form action="{{ route('laporanKain.generate-report-kain') }}" method="post" id="reportForm">
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
									value="{{ old('end_date') }}" />
								@error('end_date')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="stok_lama" class="form-label">Stok Lama</label>
								<div class="form-check">
									<input type="checkbox" class="form-check-input @error('stok_lama') is-invalid @enderror" id="stok_lama"
										name="stok_lama" value="STOK LAMA" {{ old('stok_lama') == 'STOK LAMA' ? 'checked' : '' }}>
									<label class="form-check-label" for="stok_lama">Centang jika ini Stok Lama</label>
								</div>
								@error('stok_lama')
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
		<div class="col-6">
			<h2 class="fw-bold">
				<span class="text-muted fw-light py-5"></span>
				.
			</h2>
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						Cari berdasar Nama Kain
						<hr>
					</div>
				</div>
				<div class="card-body">
					<div class="alert alert-primary" role="alert">
						Masukkan Nama Kain
					</div>
					<form action="{{ route('laporanKain.generate-report-kain-nama') }}" method="post" id="reportForm">
						@csrf
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="nama_kain" class="form-label">Nama Kain</label>
								<input class="form-control @error('nama_kain') is-invalid @enderror" type="text" id="nama_kain"
									name="nama_kain" value="{{ old('nama_kain') }}" />
								@error('nama_kain')
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
