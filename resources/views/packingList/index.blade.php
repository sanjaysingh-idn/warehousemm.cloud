@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					{{-- <div class="text-start">
						<a href="/kain/create" class="btn btn-primary"><i class="bx bx-plus-circle"></i> Tambah Kain</a>
					</div> --}}
				</div>

				<div class="card-body">
					<div class=" text-nowrap">
						<table id="table" class="table table-bordered table-hover w-100" style="width: 100%">
							<caption class="ms-4">

							</caption>
							<thead class="bg-warning mt-5">
								<tr>
									{{-- <th>Foto Kain</th> --}}
									<th class="text-white">No</th>
									<th class="text-white">PL No</th>
									<th class="text-white">Jenis</th>
									<th class="text-white">Tanggal</th>
									<th class="text-white">Pengambil</th>
									<th class="text-white">Tujuan</th>
									<th class="text-white">Total Pcs</th>
									<th class="text-white">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($packingList as $key => $item)
									<tr>
										<td>
											{{ $key + 1 }}
										</td>
										<td>
											{{ $item->packingListNo }}
										</td>
										<td>
											<span
												class="
											@if ($item->jenis == 'Brocade/Tule') bg-success text-black
        									@elseif($item->jenis == 'Basic') bg-primary text-white
        									@elseif($item->jenis == 'Gent') bg-danger text-white
        									@elseif($item->jenis == 'Grosir') bg-info text-white
        									@elseif($item->jenis == 'Cabang') bg-warning text-white
        									@elseif($item->jenis == 'Ladys') bg-dark text-white @endif
											p-2">
												<strong>{{ $item->jenis }}</strong>
											</span>
										</td>
										<td>
											{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}
										</td>
										<td>
											<strong>{{ $item->nama_pengambil }}</strong>
										</td>
										<td>
											<strong>{{ $item->tujuan }}</strong>
										</td>
										<td>
											<strong>{{ $item->total_pcs }} Pcs</strong>
										</td>
										<td>
											<a href="{{ route('generatePDF', ['id' => $item->id]) }}" target="_blank" class="btn btn-xs btn-primary">
												<i class="bx bxs-file-pdf me-1"></i>
												Cetak PDF
											</a>

											<button class="btn btn-xs btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}">
												<i class="bx bx-info-circle me-1"></i>
												Info
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
	{{-- Modal Detail --}}
	@foreach ($packingList as $item)
		<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-info pb-3">
						<h5 class="modal-title text-white" id="modalDetailTitle">Detail Packing List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-12 mb-2">
										<p>Jenis: </p>
										<h3>
											<span class="bg-success p-2 text-black">
												<strong>{{ $item->jenis }}</strong>
											</span>
										</h3>
									</div>
									<div class="col-12">
										<p>Kode: <br>
											<strong>{{ $item->packingListNo }}</strong>
										</p>
									</div>
									<div class="col-12">
										<p>Tujuan: <br>
											<strong>{{ $item->tujuan }}</strong>
										</p>
									</div>
									<div class="col-sm-4">
										<p>Nama Pengambil: <br>
											<strong>{{ $item->nama_pengambil }}</strong>
										</p>
									</div>
									<div class="col-sm-4">
										<p>Nama Security: <br>
											<strong>{{ $item->nama_security }}</strong>
										</p>
									</div>
									<div class="col-sm-4">
										<p>Nama Koordinator: <br>
											<strong>{{ $item->nama_koordinator }}</strong>
										</p>
									</div>
									<hr>
								</div>
								<div class="row">
									@if ($item->barang)
										{!! $item->barang !!}
									@else
										<div class="col-12">
											<div class="my-2">
												<p><strong>Data Barang Keluar</strong></p>
												<div class="table-responsive">
													<table id="table" class="table table-hover w-100" style="width: 100% !important;">
														<caption class="ms-4">
															Total Pcs: {{ $item->total_pcs }} Pcs
														</caption>
														<thead class="bg-warning mt-5">
															<tr>
																{{-- <th>Foto Kain</th> --}}
																<th class="text-white">No</th>
																<th class="text-white">Nama Kain</th>
																<th class="text-white">Color</th>
																<th class="text-white">Total</th>
																<th class="text-white">Pcs</th>
															</tr>
														</thead>
														<tbody>
															@forelse ($item->kains as $key => $kain)
																<tr>
																	<td>{{ $key + 1 }}</td>
																	<td>
																		{{ $kain->nama_kain }}
																		@if ($kain->nama_desain !== '-' || $kain->nama_desain !== null)
																			<br>
																			<span class="badge bg-primary">{{ $kain->nama_desain }}</span>
																		@endif
																	</td>
																	<td>
																		@foreach ($kain->warnas as $warna)
																			{{ $warna->nama_warna }} <br>
																		@endforeach
																	</td>
																	<td>
																		@foreach ($kain->warnas as $warna)
																			{{ $warna->pcs->count() }} pcs <br>
																		@endforeach
																	</td>
																	<td>
																		@foreach ($kain->warnas as $warna)
																			@foreach ($warna->pcs as $pcs)
																				{{ $pcs->yard }}y,
																			@endforeach
																			<br>
																		@endforeach
																	</td>
																</tr>
															@empty
																<tr>
																	<td colspan="4">No data available</td>
																</tr>
															@endforelse
														</tbody>
													</table>
												</div>
											</div>
										</div>
									@endif
								</div>
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

	{{-- Modal Delete --}}
	@foreach ($packingList as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger pb-3">
						<h5 class="modal-title text-white" id="modalDeleteTitle">Delete Packing List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('packingList.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4 class="alert-heading">Apakah anda yakin ingin menghapus data Packing List ini?</h4>
									<div class="row">
										<div class="col-12">
											<p><strong>Kode: {{ $item->packingListNo }}</strong></p>
										</div>
										<div class="col-sm-4">
											<p>Nama Pengambil: <br>
												<strong>{{ $item->nama_pengambil }}</strong>
											</p>
										</div>
										<div class="col-sm-4">
											<p>Nama Security: <br>
												<strong>{{ $item->nama_security }}</strong>
											</p>
										</div>
										<div class="col-sm-4">
											<p>Nama Koordinator: <br>
												<strong>{{ $item->nama_koordinator }}</strong>
											</p>
										</div>
									</div>
									<div class="my-2">
										{!! $item->barang !!}
									</div>
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

		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
			$('#supplier').select2();
		});
	</script>
@endpush
