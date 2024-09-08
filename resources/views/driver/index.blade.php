@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }} <i
				class="bx bxs-truck fs-4 ms-2"></i>
		</h2>
		<div class="col-sm-6 mb-2">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddSopir"><i
								class="bx bx-plus-circle"></i> Tambah Sopir</button>
					</div>
				</div>

				<div class="card-body">
					<div class=" text-nowrap">
						<div class="table-responsive">
							<table class="table table-hover">
								<caption class="ms-4"></caption>
								<thead>
									<tr>
										<th>Nama Sopir</th>
										<th>Kontak</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($sopir as $item)
										<tr>
											<td>{{ $item->nama }}</td>
											<td>{{ $item->kontak }}</td>
											<td>
												<button class="btn btn-xs btn-danger" data-bs-toggle="modal"
													data-bs-target="#modalDeleteSopir{{ $item->id }}">
													<i class="bx bx-trash me-1"></i>
													Delete
												</button>
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
		<div class="col-sm-6 mb-2">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddMobil"><i
								class="bx bx-plus-circle"></i> Tambah Kendaraan</button>
					</div>
				</div>

				<div class="card-body">
					<div class=" text-nowrap">
						<div class="table-responsive">
							<table class="table table-hover" style="width: 100%">
								<caption class="ms-4"></caption>
								<thead>
									<tr>
										<th>Kendaraan</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($mobil as $item)
										<tr>
											<td>{{ $item->nama_mobil }}</td>
											<td>
												<button class="btn btn-xs btn-danger" data-bs-toggle="modal"
													data-bs-target="#modalDeleteMobil{{ $item->id }}">
													<i class="bx bx-trash me-1"></i>
													Delete
												</button>
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
		<div class="col-12 mt-3">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Tambah Notebook Driver</button>
					</div>
				</div>

				<div class="card-body">
					<div class=" text-nowrap">
						<table id="table" class="table table-hover" style="width: 100%">
							<caption class="ms-4"></caption>
							<thead>
								<tr>
									<th>No</th>
									<th>Driver</th>
									<th>Tujuan (Nama Pembeli)</th>
									<th>Pergi</th>
									<th>Pulang</th>
									<th>Barang</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($driver as $item)
									<tr>
										<td>{{ $no++ }}</td>
										<td>
											{{ $item->sopir }}
											<br>
											@if ($item->kernet)
												<small>Ajudan: {{ $item->kernet }}</small>
											@endif
										</td>
										<td>{{ $item->tujuan }} @if ($item->nama_pembeli)
												({{ $item->nama_pembeli }})
											@endif
										</td>
										<td>{{ $item->pergi }}</td>
										<td>{{ $item->pulang }}</td>
										<td>
											@if ($item->barang)
												{{ $item->barang }}
											@endif
										</td>
										<td>
											<button class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
												<i class="bx bx-edit-alt me-1"></i>
												Edit
											</button>
											<button class="btn btn-xs btn-danger" data-bs-toggle="modal"
												data-bs-target="#modalDelete{{ $item->id }}">
												<i class="bx bx-trash me-1"></i>
												Delete
											</button>
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

	{{-- Modal Tambah Sopir --}}
	<div class="modal fade" id="modalAddSopir" tabindex="-1" aria-modal="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white pb-3" id="modalAddTitle">Tambah Driver</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('sopir.store') }}" method="POST">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="nama" class="form-label">Nama Driver</label>
								<input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama"
									value="{{ old('nama') }}" required />
								@error('nama')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="kontak" class="form-label">Kontak</label>
								<input class="form-control @error('kontak') is-invalid @enderror" type="text" id="kontak" name="kontak"
									value="{{ old('kontak') }}" required />
								@error('kontak')
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

	{{-- Modal Tambah Mobil --}}
	<div class="modal fade" id="modalAddMobil" tabindex="-1" aria-modal="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white pb-3" id="modalAddTitle">Tambah Kendaraan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('mobil.store') }}" method="POST">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="nama_mobil" class="form-label">Kendaraan</label>
								<input class="form-control @error('nama_mobil') is-invalid @enderror" type="text" id="nama_mobil"
									name="nama_mobil" value="{{ old('nama_mobil') }}" required />
								@error('nama_mobil')
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

	{{-- Modal Tambah --}}
	<div class="modal fade" id="modalAdd" tabindex="-1" aria-modal="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white pb-3" id="modalAddTitle">Tambah Notebook Driver</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('driver.store') }}" method="POST">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="sopir" class="form-label">Driver</label>
								<select id="sopir" class="form-select @error('sopir') is-invalid @enderror" name="sopir"
									data-placeholder="--Pilih Driver--" required style="width: 100%">
									<option value="" class="text-capitalize" hidden>--Pilih Driver--</option>
									@foreach ($sopir as $sp)
										<option value="{{ $sp->nama }}">{{ $sp->nama }}</option>
									@endforeach
								</select>
								@error('sopir')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="mobil" class="form-label">Mobil</label>
								<select id="mobil" class="form-select @error('mobil') is-invalid @enderror" name="mobil"
									data-placeholder="--Pilih Mobil--" required style="width: 100%">
									<option value="" class="text-capitalize" hidden>--Pilih Mobil--</option>
									@foreach ($mobil as $mb)
										<option value="{{ $mb->nama_mobil }}">{{ $mb->nama_mobil }}</option>
									@endforeach
								</select>
								@error('mobil')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="kernet" class="form-label">Kernet (Boleh Kosong)</label>
								<input class="form-control @error('kernet') is-invalid @enderror" type="text" id="kernet"
									name="kernet" value="{{ old('kernet') }}" />
								@error('kernet')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="tujuan" class="form-label">Tujuan</label>
								<input class="form-control @error('tujuan') is-invalid @enderror" type="text" id="tujuan"
									name="tujuan" value="{{ old('tujuan') }}" required />
								@error('tujuan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="nama_pembeli" class="form-label">Nama Pembeli (Boleh Kosong)</label>
								<input class="form-control @error('nama_pembeli') is-invalid @enderror" type="text" id="nama_pembeli"
									name="nama_pembeli" value="{{ old('nama_pembeli') }}" />
								@error('nama_pembeli')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="barang" class="form-label">Barang (Boleh Kosong)</label>
								<input class="form-control @error('barang') is-invalid @enderror" type="text" id="barang"
									name="barang" value="{{ old('barang') }}" />
								@error('barang')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="pergi" class="form-label">Pergi</label>
								<input class="form-control @error('pergi') is-invalid @enderror" type="datetime-local" id="pergi"
									name="pergi" value="{{ old('pergi') }}" required />
								@error('pergi')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="pulang" class="form-label">Pulang</label>
								<input class="form-control @error('pulang') is-invalid @enderror" type="datetime-local" id="pulang"
									name="pulang" value="{{ old('pulang') }}" />
								@error('pulang')
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
	@foreach ($driver as $item)
		<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning">
						<h5 class="modal-title text-white pb-3" id="modalEditTitle">Edit Notebook Driver</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('driver.update', $item->id) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12 mb-3">
									<label for="sopir" class="form-label">Driver</label>
									<select id="sopir" class="form-select @error('sopir') is-invalid @enderror" name="sopir"
										data-placeholder="--Pilih Driver--" required style="width: 100%">
										<option value="" class="text-capitalize" hidden>--Pilih Driver--</option>
										@foreach ($sopir as $sp)
											<option value="{{ $sp->nama }}" {{ old('sopir', $item->sopir ?? '') == $sp->nama ? 'selected' : '' }}>
												{{ $sp->nama }}</option>
										@endforeach
									</select>
									@error('sopir')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="col-sm-12 mb-3">
									<label for="mobil" class="form-label">Mobil</label>
									<select id="mobil" class="form-select @error('mobil') is-invalid @enderror" name="mobil"
										data-placeholder="--Pilih Mobil--" required style="width: 100%">
										<option value="" class="text-capitalize" hidden>--Pilih Mobil--</option>
										@foreach ($mobil as $mb)
											<option value="{{ $mb->nama_mobil }}"
												{{ old('mobil', $item->mobil ?? '') == $mb->nama_mobil ? 'selected' : '' }}>{{ $mb->nama_mobil }}
											</option>
										@endforeach
									</select>
									@error('mobil')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>

								<!-- Other form fields -->
								<div class="col-sm-6 mb-3">
									<label for="pergi" class="form-label">Pergi</label>
									<input class="form-control @error('pergi') is-invalid @enderror" type="datetime-local" id="pergi"
										name="pergi" value="{{ old('pergi', $item->pergi ?? '') }}" required />
									@error('pergi')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="col-sm-6 mb-3">
									<label for="pulang" class="form-label">Pulang</label>
									<input class="form-control @error('pulang') is-invalid @enderror" type="datetime-local" id="pulang"
										name="pulang" value="{{ old('pulang', $item->pulang ?? '') }}" />
									@error('pulang')
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
							<button type="submit" class="btn btn-warning"><i class="bx bx-save"></i> Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach

	{{-- Modal Delete --}}
	@foreach ($sopir as $item)
		<div class="modal fade" id="modalDeleteSopir{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger pb-3">
						<h5 class="modal-title text-white" id="modalDeleteTitle">Delete Driver</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('sopir.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4 class="alert-heading">Apakah anda yakin ingin menghapus data Driver {{ $item->nama }}</h4>
									<p><strong>{{ $item->nama_supplier }}</strong> ?</p>
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

	{{-- Modal Delete --}}
	@foreach ($mobil as $item)
		<div class="modal fade" id="modalDeleteMobil{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger pb-3">
						<h5 class="modal-title text-white" id="modalDeleteTitle">Delete Mobil</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('mobil.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4 class="alert-heading">Apakah anda yakin ingin menghapus data Mobil {{ $item->mobil }}</h4>
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
		$('#table').DataTable({
			responsive: {
				details: {
					display: DataTable.Responsive.display.modal({
						header: function(row) {
							var data = row.data();
							return data[0] + ' ' + data[1] + '<hr>';
						}
					}),
					renderer: DataTable.Responsive.renderer.tableAll({
						tableClass: 'table'
					})
				}
			}
		});

		'use strict';
	</script>
@endpush
