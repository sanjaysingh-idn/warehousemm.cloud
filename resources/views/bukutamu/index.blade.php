@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> <i class="bx bxs-user-rectangle"></i>
			{{ $title }}
		</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Tambah Tamu</button>
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
									<th>Hari/Tgl</th>
									<th>Jam Masuk/Keluar</th>
									<th>Keperluan</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($tamu as $item)
									<tr>
										<td>{{ $item->nama }}</td>
										<td>{{ date('l, j F Y', strtotime($item->hari)) }}</td>
										<td>{{ date('H:i', strtotime($item->jam_masuk)) }} WIB - {{ date('H:i', strtotime($item->jam_keluar)) }} WIB
										</td>
										<td>{{ $item->keperluan }}</td>
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
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white pb-3" id="modalAddTitle">Tambah Tamu</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('bukutamu.store') }}" method="POST">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="nama" class="form-label">Nama Tamu</label>
								<input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama"
									value="{{ old('nama') }}" />
								@error('nama')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="hari" class="form-label">Hari/Tanggal</label>
								<input class="form-control @error('hari') is-invalid @enderror" type="date" id="hari" name="hari"
									value="{{ old('hari') }}" max="{{ date('Y-m-d') }}" />
								@error('hari')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="jam_masuk" class="form-label">Jam Masuk</label>
								<input class="form-control @error('jam_masuk') is-invalid @enderror" type="time" id="jam_masuk"
									name="jam_masuk" value="{{ old('jam_masuk') }}" />
								@error('jam_masuk')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="jam_keluar" class="form-label">Jam Keluar</label>
								<input class="form-control @error('jam_keluar') is-invalid @enderror" type="time" id="jam_keluar"
									name="jam_keluar" value="{{ old('jam_keluar') }}" />
								@error('jam_keluar')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="keperluan" class="form-label">keperluan</label>
								<input class="form-control @error('keperluan') is-invalid @enderror" type="text" id="keperluan"
									name="keperluan" value="{{ old('keperluan') }}" />
								@error('keperluan')
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
	@foreach ($tamu as $item)
		<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning pb-3">
						<h5 class="modal-title text-white" id="modalEditTitle">
							Edit Tamu
							<span class="text-black fw-bold">{{ $item->name }}</span>
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('bukutamu.update', $item->id) }}" method="POST">
						@csrf
						@method('put')
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12 mb-3">
									<label for="nama" class="form-label">Nama Tamu</label>
									<input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama"
										value="{{ $item->nama }}" />
									@error('nama')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-6 mb-3">
									<label for="hari" class="form-label">Hari/Tanggal</label>
									<input class="form-control @error('hari') is-invalid @enderror" type="date" id="hari" name="hari"
										value="{{ $item->hari }}" />
									@error('hari')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 mb-3">
									<label for="jam_masuk" class="form-label">Jam Masuk</label>
									<input class="form-control @error('jam_masuk') is-invalid @enderror" type="time" id="jam_masuk"
										name="jam_masuk" value="{{ $item->jam_masuk }}" />
									@error('jam_masuk')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-6 mb-3">
									<label for="jam_keluar" class="form-label">Jam Keluar</label>
									<input class="form-control @error('jam_keluar') is-invalid @enderror" type="time" id="jam_keluar"
										name="jam_keluar" value="{{ $item->jam_keluar }}" />
									@error('jam_keluar')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="keperluan" class="form-label">keperluan</label>
									<input class="form-control @error('keperluan') is-invalid @enderror" type="text" id="keperluan"
										name="keperluan" value="{{ $item->keperluan }}" />
									@error('keperluan')
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
	@foreach ($tamu as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger pb-3">
						<h5 class="modal-title text-white" id="modalDeleteTitle">Delete Tamu</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('bukutamu.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4 class="alert-heading">Apakah anda yakin ingin menghapus data Tamu</h4>
									<p><strong>{{ $item->nama }}</strong> ?</p>
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
				order: [
					[1, "desc"]
				]
			});
		});

		'use strict';
	</script>
@endpush
