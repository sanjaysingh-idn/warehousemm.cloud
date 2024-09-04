@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> <i class="bx bx-user-voice"></i>
			{{ $title }}
		</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-user-voice"></i> Tambah Security</button>
					</div>
				</div>

				<div class="card-body">
					<div class=" text-nowrap">
						<table id="table" class="table table-hover w-100">
							<caption class="ms-4">

							</caption>
							<thead>
								<tr>
									<th>Nama</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($security as $item)
									<tr>
										<td>{{ $item->nama_security }}</td>
										<td>
											@if (Auth()->user()->role === 'superadmin')
												<button class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
													<i class="bx bx-edit-alt me-1"></i>
													Edit
												</button>
												<button class="btn btn-xs btn-danger" data-bs-toggle="modal"
													data-bs-target="#modalDelete{{ $item->id }}">
													<i class="bx bx-trash me-1"></i>
													Delete
												</button>
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
	<!--/ User Profile Content -->
@endsection

@push('modals')

	{{-- Modal Tambah --}}
	<div class="modal fade" id="modalAdd" tabindex="-1" aria-modal="true">
		<div class="modal-dialog modal-sm modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white pb-3" id="modalAddTitle">Tambah Security</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('security.store') }}" method="POST">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="nama_security" class="form-label">Nama Security</label>
								<input class="form-control @error('nama_security') is-invalid @enderror" type="text" id="nama_security"
									name="nama_security" value="{{ old('nama_security') }}" />
								@error('nama_security')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Modal Edit --}}
	@foreach ($security as $item)
		<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning pb-3">
						<h5 class="modal-title text-white" id="modalEditTitle">
							Edit Security
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('security.update', $item->id) }}" method="POST">
						@csrf
						@method('put')
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12 mb-3">
									<label for="nama_security" class="form-label">Nama Security</label>
									<input class="form-control @error('nama_security') is-invalid @enderror" type="text" id="nama_security"
										name="nama_security" value="{{ $item->nama_security }}" />
									@error('nama_security')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-warning"><i class="bx bx-edit-alt"></i> Edit data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach

	{{-- Modal Delete --}}
	@foreach ($security as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger pb-3">
						<h5 class="modal-title text-white" id="modalDeleteTitle">Delete Security</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('security.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4 class="alert-heading">Apakah anda yakin ingin menghapus data Security</h4>
									<p><strong>{{ $item->nama_security }}</strong> ?</p>
									<hr>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i> Hapus data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach

@endpush

@push('scripts')
	<script>
		$(document).ready(function() {
			$('#table').DataTable({
				// "dom": 'rtip',
				responsive: true,
			});
		});

		'use strict';
	</script>
@endpush
