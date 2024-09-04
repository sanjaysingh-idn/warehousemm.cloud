@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-6">
							<div class="text-start mb-3">
								<a href="/kain" class="btn btn-secondary"><i class="bx bx-left-arrow-circle"></i> Kembali</a>
							</div>
							<div class="text-start">
								<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
									<i class="bx bx-plus-circle me-1"></i>
									Tambah Warna
								</button>
							</div>
							<div class="mt-3">
								Daftar Warna untuk kain <strong>{{ $kain->nama_kain }}</strong> - <strong>{{ $kain->kode_desain }}</strong>
								@if ($kain->lot)
									- Lot : {{ $kain->lot }}
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class=" text-nowrap">
						<table id="table" class="table table-hover w-100" style="width: 100%">
							<caption class="ms-4">
								Total Pcs: <strong>{{ $kain->warnas->sum(function ($warna) {return $warna->total_pcs;}) }}</strong>
								<br>
								@if ($kain->satuan == 'Y')
									Total Yard: <strong> {{ $kain->warnas->sum(function ($warna) {return $warna->pcs->sum('yard');}) }}</strong>
								@elseif ($kain->satuan == 'M')
									Total Meter: <strong> {{ $kain->warnas->sum(function ($warna) {return $warna->pcs->sum('yard');}) }}</strong>
								@endif
							</caption>
							<thead class="bg-dark mt-5">
								<tr>
									{{-- <th>Foto Kain</th> --}}
									<th class="text-white">Nama Warna</th>
									<th class="text-white">Pcs Tersedia</th>
									<th class="text-white">Total Pcs</th>
									<th class="text-white">Daftar Pcs</th>
									<th class="text-white">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($warna as $item)
									<tr class="{{ $item->total_ready_pcs == 0 ? 'bg-dark' : '' }}">
										<td class="{{ $item->total_ready_pcs == 0 ? 'text-white' : '' }}">{{ $item->nama_warna }}</td>
										<td>
											<span class="badge bg-dark"><strong>{{ $item->total_ready_pcs }} Pcs</strong></span>
										</td>
										<td class="{{ $item->total_ready_pcs == 0 ? 'text-white' : '' }}">
											@if ($kain->satuan == 'Y')
												{{ $item->total_pcs }} Pcs &
												{{ $item->pcs->sum('yard') }} Yard
											@elseif ($kain->satuan == 'M')
												{{ $item->total_pcs }} Pcs &
												{{ $item->pcs->sum('yard') }} Meter
											@else
												{{ $item->total_pcs }} Pcs
											@endif
										</td>
										<td>
											<a href="{{ route('kain.warna.pcs.list', ['kain' => $kain->id, 'warna' => $item->id]) }}"
												class="btn btn-xs btn-info">
												<i class="bx bxs-add-to-queue me-1"></i>
												Daftar Pcs
											</a>
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

	{{-- Modal Tambah --}}
	<div class="modal fade" id="modalAdd" tabindex="-1" aria-modal="true">
		<div class="modal-dialog modal-sm modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white pb-3" id="modalAddTitle">Tambah Warna</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('warna.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<input type="hidden" value="{{ $kain->id }}" name="kain_id">
								<label for="nama_warna" class="form-label">Nama Warna</label>
								<input class="form-control @error('nama_warna') is-invalid @enderror" type="text" id="nama_warna"
									name="nama_warna" value="{{ old('nama_warna') }}" required />
								@error('nama_warna')
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
						<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Tambah Warna</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Modal Edit --}}
	@foreach ($warna as $item)
		<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning pb-3">
						<h5 class="modal-title text-white" id="modalEditTitle">
							Edit Warna
							<span class="text-black fw-bold">{{ $item->nama_warna }}</span>
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('warna.update', $item->id) }}" method="POST">
						@csrf
						@method('put')
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-6 mb-3">
									<label for="nama_warna" class="form-label">Nama Warna</label>
									<input class="form-control @error('nama_warna') is-invalid @enderror" type="text" id="nama_warna"
										name="nama_warna" value="{{ $item->nama_warna }}" />
									@error('nama_warna')
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
	@foreach ($warna as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger pb-3">
						<h5 class="modal-title text-white" id="modalDeleteTitle">Delete Kain</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('warna.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4 class="alert-heading">Apakah anda yakin ingin menghapus data Kain</h4>
									<p><strong>{{ $item->nama_warna }}</strong> ?</p>
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
	{{-- <script>
		$(document).ready(function() {
			$('#table').DataTable({
				"ordering": false,
				"columnDefs": [{
					"type": "natural",
					"targets": 0
				}],
			});
		});

		'use strict';
	</script> --}}
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
