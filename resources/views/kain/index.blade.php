@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
		<div class="col-12">
			<div class="card mb-3">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-3 border-end mb-2">
							<p>Search ID</p>
							<form action="{{ route('kain.search') }}" method="post">
								@csrf
								<label for="search_id" class="form-label">Cari Berdasarkan ID</label>
								<input class="form-control @error('search_id') is-invalid @enderror" type="text" id="search_id"
									name="search_id" value="{{ old('search_id') }}" placeholder="Masukkan ID" />
								@error('search_id')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
								<button type="submit" class="btn btn-primary mt-2">
									<i class="bx bx-search-alt"></i> Search
								</button>
							</form>
						</div>
						<div class="col-sm-3 border-end">
							<p>Tampil Seluruh Foto kain</p>
							<div class="mb-3">
								<button type="submit" class="btn btn-primary">
									<i class="bx bx-images"></i> All Images
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class=" text-nowrap">
						<div class="table-responsive">
							<table id="table" class="table table-hover w-100" style="width: 100%">
								<caption class="ms-4">

								</caption>
								<thead class="bg-warning mt-5">
									<tr>
										<th class="text-white">No</th>
										<th style="display: none;" class="hidden">ID</th>
										{{-- <th class="text-white">Foto</th> --}}
										<th class="text-white">Nama Kain</th>
										<th style="display: none;" class="hidden">Surat Jalan</th>
										<th style="display: none;" class="hidden">Supplier</th>
										{{-- <th class="text-white">Supplier</th> --}}
										{{-- <th class="text-white">Pcs Ready</th>
										<th class="text-white">Pcs Keluar</th> --}}
										<th class="text-white">Tgl Masuk</th>
										<th class="text-white">Link</th>
										<th class="text-white">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($kain as $index => $item)
										<tr class="{{ $item->status == 1 ? 'bg-dark' : '' }}">
											<td class="{{ $item->status == 1 ? 'text-white' : '' }}">{{ $index + 1 }}</td>
											<td style="display: none;" class="hidden">
												{{ $item->id }}
											</td>
											{{-- <td> --}}
											{{-- @php
													$qrCodeData = "Nama Kain: {$item->nama_kain}, Supplier: {$item->supplier->nama_supplier}";
												@endphp
												{!! QrCode::generate($qrCodeData) !!} --}}
											{{-- @if ($item->qrcode_path)
													<div class="p-2">
														<img src="{{ asset('storage/' . $item->qrcode_path) }}" class="img-fluid rounded-top" width="50"
															alt="{{ $item->nama_kain }}">
													</div>
												@elseif ($item->foto_kain)
													<div class="p-2">
														<img src="{{ asset('storage/' . $item->foto_kain) }}" class="img-fluid rounded-top" width="50"
															alt="{{ $item->nama_kain }}">
													</div>
												@else
													-
												@endif --}}
											{{-- </td> --}}
											<td class="{{ $item->status == 1 ? 'text-white' : '' }}">
												{{ $item->nama_kain }} <br>
												@if ($item->kode_desain)
													<strong>{{ $item->kode_desain }}</strong>
												@endif
											</td>
											<td style="display: none;" class="hidden">
												{{ $item->surat_jalan }}
											</td>
											<td style="display: none;" class="hidden">
												{{ $item->supplier->nama_supplier }}
											</td>
											{{-- <td>
												<span class="badge bg-dark">{{ $item->pcsCountWhereSatuanNull() }} Pcs</span>
											</td>
											<td>
												<span class="badge bg-light text-dark fw-bold shadow">{{ $item->pcsCountWhereSatuanNotNull() }} Pcs</span>
											</td> --}}
											<td class="{{ $item->status == 1 ? 'text-white' : '' }}">
												{{ \Carbon\Carbon::parse($item->tgl_masuk)->isoFormat('D MMMM Y') }}
											</td>
											<td>
												<a href="{{ route('kain.warna.list', ['kain' => $item->id]) }}" class="btn btn-xs btn-primary">
													<i class="bx bx-color me-1"></i>
													Daftar Warna
												</a>

												<a href="{{ route('kain.barcode', ['kain' => $item->id]) }}" target="_blank"
													class="btn btn-xs btn-outline-primary">
													<i class="bx bx-barcode me-1"></i>
													Cetak Barcode
												</a>
											</td>
											<td>
												<a href="{{ route('laporanPerKain', ['kain' => $item->id]) }}" target="_blank"
													class="btn btn-xs btn-success">
													<i class="bx bxs-file-pdf me-1"></i>
													Cetak Laporan
												</a>

												<a href="{{ route('kain.edit', ['kain' => $item->id]) }}" class="btn btn-xs btn-warning">
													<i class="bx bx-edit-alt me-1"></i>
													Edit
												</a>

												<button class="btn btn-xs btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}">
													<i class="bx bx-info-circle me-1"></i>
													Info
												</button>

												<button class="btn btn-xs btn-dark" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $item->id }}">
													<i class="bx bx-stats me-1"></i>
													Status
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
							{{-- {{ $kain->links() }} --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ User Profile Content -->
@endsection

@push('modals')

	{{-- Modal Detail --}}
	@foreach ($kain as $item)
		<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-info pb-3">
						<h5 class="modal-title text-white" id="modalDetailTitle">Detail Kain</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-12 text-center">
								<strong>Foto Kain</strong>
								<div class="head-modal text-center mx-auto justify-content-center">
									<img src="{{ asset('storage/' . $item->foto_kain) }}"
										class="img-thumbnail clickable-image lightbox mx-auto py-3 zoom" width="200" frameborder="0">
								</div>
							</div>
							<div class="col-12">
								<table class="table">
									<tr>
										<td style="width: 40%">Nama Kain</td>
										<td style="width: 60%" class="fw-bold">{{ $item->nama_kain }}</td>
									</tr>
									<tr>
										<td style="width: 40%">Surat Jalan</td>
										<td style="width: 60%" class="fw-bold">{{ $item->surat_jalan }}</td>
									</tr>
									<tr>
										<td style="width: 40%">Kode Desain</td>
										<td style="width: 60%" class="fw-bold">{{ $item->kode_desain }}</td>
									</tr>
									<tr>
										<td style="width: 40%">Lot</td>
										<td style="width: 60%" class="fw-bold">{{ $item->lot }}</td>
									</tr>
									<tr>
										<td style="width: 40%">Harga</td>
										<td style="width: 60%" class="fw-bold">{{ $item->harga }} per {{ $item->satuan }}</td>
									</tr>
									<tr>
										<td style="width: 40%">Supplier</td>
										<td style="width: 60%" class="fw-bold">{{ $item->supplier->nama_supplier }}</td>
									</tr>
									<tr>
										<td style="width: 40%">Lokasi</td>
										<td style="width: 60%" class="fw-bold">{{ $item->lokasi }}</td>
									</tr>
									<tr>
										<td style="width: 40%">Keterangan</td>
										<td style="width: 60%" class="fw-bold">{{ $item->keterangan }}</td>
									</tr>
								</table>
							</div>

							<div class="col-12 mt-5">
								<caption><strong>Input By</strong></caption>
								<table class="table">
									<tr>
										<td style="width: 40%">Diinput Oleh</td>
										<td style="width: 60%" class="fw-bold">{{ $item->input_by }}</td>
									</tr>
									<tr>
										<td style="width: 40%">Diinput Pada</td>
										<td style="width: 60%" class="fw-bold">{{ date('j F Y - H:i:s ', strtotime($item->input_at)) }}</td>
									</tr>
								</table>
							</div>
							<div class="col-12 mt-5">
								<caption><strong>Update By</strong></caption>
								<table class="table">
									<tr>
										<td style="width: 40%">Diubah Oleh</td>
										<td style="width: 60%" class="fw-bold">{{ $item->update_by }}</td>
									</tr>
									<tr>
										<td style="width: 40%">Diubah Pada</td>
										<td style="width: 60%" class="fw-bold">
											@if ($item->update_at)
												{{ date('j F Y - H:i:s', strtotime($item->update_at)) }}
											@endif
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">
							Close
						</button>
					</div>
				</div>
			</div>
		</div>
	@endforeach

	{{-- Modal Status --}}
	@foreach ($kain as $item)
		<div class="modal fade" id="modalStatus{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-dark pb-3">
						<h5 class="modal-title text-white" id="modalStatusTitle">Status Kain</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="updateStatusForm" action="{{ route('kain.updateStatus', $item->id) }}" method="POST">
							@csrf
							@method('patch')
							<div class="modal-body">
								<div class="row">
									<div class="col-12">
										<h4 class="alert-heading">Update Status for <strong>{{ $item->nama_kain }}</strong></h4>
										<div class="mb-3">
											<label for="status" class="form-label">Status</label>
											<select class="form-select" name="status" id="status">
												<option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Habis</option>
												<option value="" {{ $item->status == '' ? 'selected' : '' }}>Ready</option>
											</select>
										</div>
										<hr>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
									Close
								</button>
								<button type="submit" id="updateStatusBtn" class="btn btn-dark"><i class="bx bx-check"></i> Update
									Status</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endforeach

	{{-- Modal Delete --}}
	@foreach ($kain as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger pb-3">
						<h5 class="modal-title text-white" id="modalDeleteTitle">Delete Kain</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('kain.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4 class="alert-heading">Apakah anda yakin ingin menghapus data Kain</h4>
									<p><strong>{{ $item->nama_kain }}</strong> ?</p>
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
		function updateStatus(itemId) {
			// Get form data
			var formData = $("#updateStatusForm" + itemId).serialize();

			// Make AJAX request
			$.ajax({
				url: "{{ url('kain/updateStatus') }}/" + itemId,
				type: "PATCH",
				data: formData,
				success: function(response) {
					// Handle success with SweetAlert
					Swal.fire({
						title: 'Success!',
						text: '{{ session('message') }}',
						icon: 'success',
						confirmButtonText: 'OK'
					});

					// You can also close the modal if needed
					$("#modalStatus" + itemId).modal("hide");
				},
				error: function(error) {
					// Handle error, e.g., display an error message
					console.log(error);
					alert("Error updating status!");
				}
			});

			// Prevent the form from submitting in the traditional way
			return false;
		}
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#table').DataTable({
				responsive: true,
				// serverSide: true,
				processing: true,
				order: [], // Disable initial sorting

				// Add a search input box above the table
				initComplete: function() {
					this.api().columns().every(function() {
						var column = this;
						if ($(column.header()).hasClass('surat-jalan')) {
							var input = $(
									'<input type="text" class="form-control form-control-sm" placeholder="Search Surat Jalan">'
								)
								.appendTo($(column.header()).empty())
								.on('keyup change', function() {
									column
										.search($(this).val(), true,
											true) // true for regex, false for smart search
										.draw();
								});
						}
					});
				}
			});
		});

		'use strict';

		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
			$('#supplier').select2();
		});
	</script>
@endpush
