@extends('dashboard.layouts.main')

@section('content')
	<style>
		@media (min-width: 1360px) {

			table th,
			table td {
				white-space: nowrap;
			}

			th:nth-child(1),
			td:nth-child(1),
			/* No column */
			th:nth-child(3),
			td:nth-child(3),
			/* Nama Kain column */
			th:nth-child(4),
			td:nth-child(4),
			/* Supplier column */
			th:nth-child(5),
			td:nth-child(5)

			/* Tgl Masuk column */
				{
				min-width: 50px;
			}
		}
	</style>
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
		<div class="col-12">
			<a href="/pilihkategori" class="btn btn-secondary"><i class="bx bx-left-arrow-circle"></i> Kembali</a>
			<div class="card mb-3 mt-2">
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
					<div class="">
						<div class="row mb-5">
							@foreach ($kain as $index => $item)
								<div class="col-sm-6 col-md-4 col-lg-3 mb-4">
									<div class="card h-100 shadow-lg border-1 {{ $item->status == 1 ? 'bg-dark text-white' : '' }}">
										<!-- Fancybox image trigger -->
										<a href="{{ asset('storage/' . $item->foto_kain) }}" data-fancybox="gallery"
											data-caption="{{ $item->nama_kain }}">
											<img class="card-img-top img-fluid" src="{{ asset('storage/' . $item->foto_kain) }}"
												alt="{{ $item->nama_kain }}" style="height: auto; max-height: 250px; width: 100%; object-fit: contain;">
										</a>
										<div class="card-body d-flex flex-column pb-0">
											<h5 class="card-title mb-1 {{ $item->status == 1 ? 'text-white' : '' }}">{{ $item->nama_kain }}</h5>
											@if (!empty($item->kode_desain) && $item->kode_desain !== '-')
												<small class="text-muted mb-2">{{ $item->kode_desain }}</small>
											@endif

											@if ($item->status == 1)
												<span class="badge bg-danger">STOK HABIS</span>
											@endif

											<div class="mt-auto">
												<a href="{{ route('kain.warna.list', ['kain' => $item->id]) }}" class="btn btn-primary btn-sm mt-2">
													<i class="bx bx-color me-1"></i> Daftar Warna
												</a>
												<a href="{{ route('kain.barcode', ['kain' => $item->id]) }}" target="_blank"
													class="btn btn-outline-primary btn-sm mt-2">
													<i class="bx bx-barcode me-1"></i> Cetak Barcode
												</a>
											</div>
										</div>
										<hr>
										<div class="card-footer bg-transparent border-0">
											<div class="d-flex justify-content-between">
												<a href="{{ route('laporanPerKain', ['kain' => $item->id]) }}" target="_blank"
													class="btn btn-success btn-sm">
													<i class="bx bxs-file-pdf me-1"></i> Cetak Laporan
												</a>
												<a href="{{ route('kain.edit', ['kain' => $item->id]) }}" class="btn btn-warning btn-sm">
													<i class="bx bx-edit-alt me-1"></i> Edit
												</a>
											</div>

											<div class="d-flex justify-content-between mt-2">
												<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}">
													<i class="bx bx-info-circle me-1"></i> Info
												</button>
												<button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $item->id }}">
													<i class="bx bx-stats me-1"></i> Status
												</button>
												<button class="btn btn-danger btn-sm" data-bs-toggle="modal"
													data-bs-target="#modalDelete{{ $item->id }}">
													<i class="bx bx-trash me-1"></i> Delete
												</button>
											</div>
										</div>
									</div>
								</div>
							@endforeach
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
								<div class="text-center mt-5">
									@if ($item->stok_lama)
										<span class="badge bg-primary p-3">{{ $item->stok_lama }}</span>
									@endif
								</div>
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
		Fancybox.bind("[data-fancybox='gallery']", {
			// // Optional settings here
			// infinite: true, // Loop through images
			// keyboard: true, // Enable keyboard navigation
			// buttons: [
			// 	"zoom",
			// 	"slideShow",
			// 	"thumbs",
			// 	"close"
			// ]
		});
	</script>
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
				columnDefs: [{
						targets: 0,
						width: "50px"
					}, // No column
					{
						targets: 1,
						visible: false
					}, // ID (hidden)
					{
						targets: 2,
						width: "200px"
					}, // Nama Kain column
					{
						targets: 3,
						width: "150px"
					}, // Supplier column
					{
						targets: 4,
						visible: false
					}, // Surat Jalan (hidden)
					{
						targets: 5,
						width: "150px"
					}, // Tgl Masuk column
					{
						targets: 6,
						width: "100px"
					}, // Link column
					{
						targets: 7,
						width: "150px"
					} // Actions column
				],
				autoWidth: false,
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
