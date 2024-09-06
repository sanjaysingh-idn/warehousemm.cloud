@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }} <i
				class="bx bxs-truck fs-4 ms-2"></i>
		</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Tambah Supplier</button>
					</div>
				</div>

				<div class="card-body">
					<div class=" text-nowrap">
						<table id="table" class="table table-hover" style="width: 100%">
							<caption class="ms-4"></caption>
							<thead>
								<tr>
									<th>Nama Supplier</th>
									<th>Keterangan</th>
									{{-- @if (in_array(Auth::user()->name, ['Nickel Chainani', 'Raja Chainani', 'Sanjay Singh']))
										<th>Keterangan</th>
									@else
										-
									@endif --}}
									<th>Input By</th>
									<th>Update By</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($supplier as $item)
									<tr>
										<td>{{ $item->nama_supplier }}</td>
										<td>{{ $item->keterangan }}</td>
										{{-- @if (in_array(Auth::user()->name, ['Nickel Chainani', 'Raja Chainani', 'Sanjay Singh']))
											<td>{{ $item->keterangan }}</td>
										@else
											-
										@endif --}}
										<td>{{ $item->input_by }}</td>
										<td>{{ $item->update_by }}</td>
										<td>
											<button class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
												<i class="bx bx-edit-alt me-1"></i>
												Edit
											</button>
											<button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item->id }}">
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

	{{-- Modal Tambah --}}
	<div class="modal fade" id="modalAdd" tabindex="-1" aria-modal="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white pb-3" id="modalAddTitle">Tambah Supplier</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="nama_supplier" class="form-label">Nama Supplier</label>
								<input class="form-control @error('nama_supplier') is-invalid @enderror" type="text" id="nama_supplier"
									name="nama_supplier" value="{{ old('nama_supplier') }}" required />
								@error('nama_supplier')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="keterangan" class="form-label">Keterangan</label>
								<input class="form-control @error('keterangan') is-invalid @enderror" type="text" id="keterangan"
									name="keterangan" value="{{ old('keterangan') }}" required />
								@error('keterangan')
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
	@foreach ($supplier as $item)
		<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning pb-3">
						<h5 class="modal-title text-white" id="modalEditTitle">
							Edit Supplier : {{ $item->nama_supplier }}
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('supplier.update', $item->id) }}" method="POST">
						@csrf
						@method('put')
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12 mb-3">
									<label for="nama_supplier" class="form-label">Nama Supplier</label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" id="nama_supplier"
										name="nama_supplier" value="{{ $item->nama_supplier }}" />
									@error('nama_supplier')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="keterangan" class="form-label">keterangan</label>
									<input class="form-control @error('keterangan') is-invalid @enderror" type="text" id="keterangan"
										name="keterangan" value="{{ $item->keterangan }}" />
									@error('keterangan')
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
	@foreach ($supplier as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger pb-3">
						<h5 class="modal-title text-white" id="modalDeleteTitle">Delete Supplier</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('supplier.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4 class="alert-heading">Apakah anda yakin ingin menghapus data Kain</h4>
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
