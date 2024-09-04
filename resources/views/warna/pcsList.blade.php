@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="text-start mb-3">
						<a href="{{ route('kain.warna.list', ['kain' => $kain->id]) }}" class="btn btn-secondary">
							<i class="bx bx-left-arrow-circle me-1"></i>
							Kembali
						</a>
						<br>
						<button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#modalAdd">
							<i class="bx bx-color-fill me-1"></i>
							Tambah Pieces
						</button>
					</div>
				</div>
				<div class="card-body">
					<div class="">
						<h3>Daftar <strong>Pieces Warna <span class="bg-dark text-white p-1">{{ $warna->nama_warna }}</span></strong>
							untuk
							kain
							<strong>{{ $kain->nama_kain }}</strong> -
							<strong>{{ $kain->kode_desain }}</strong>
						</h3>
					</div>
					<hr>
					<div class="keterangan py-2">
						<div class="row">
							<div class="col-sm-1">
								<div class="box shadow bg-light">

								</div>
							</div>
							<div class="col-sm-3">
								Masih di <strong>Gudang</strong>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-1">
								<div class="box shadow bg-danger">

								</div>
							</div>
							<div class="col-sm-3">
								Keluar ke <strong>Stand</strong>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-1">
								<div class="box shadow bg-warning">

								</div>
							</div>
							<div class="col-sm-3">
								Keluar ke <strong>Cabang</strong>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-1">
								<div class="box shadow bg-info">

								</div>
							</div>
							<div class="col-sm-3">
								Keluar ke <strong>Pembeli</strong>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-1">
								<div class="box shadow bg-dark">

								</div>
							</div>
							<div class="col-sm-3">
								Keluar ke <strong>Online</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 mt-3">
			<div class="card">
				<div class="card-header">
					<div class="text-start mb-3">
						List Warna
						<br>
						<strong>Total Pcs Tersedia : {{ $getTotalReadyPcs }} pcs</strong>
					</div>
				</div>
				<div class="card-body">
					<div class="text-nowrap">
						<div class="row" id="sortable-cards">
							@foreach ($pcs as $item)
								<div class="col-sm-1 m-2" draggable="true">
									@php
										$qrCodeData = "ID: {$kain->id}, Nama Kain: {$kain->nama_kain}, Warna: {$warna->nama_warna}, Yard {$item->yard}";
									@endphp

									<div class="qr-code-container">
										{!! QrCode::size(100)->generate($qrCodeData) !!}
										<div class="download-button">
											<a href="/" class="btn btn-primary btn-sm" download>
												Download QR Code
											</a>
										</div>
									</div>

									<div
										class="box shadow mx-auto text-center
                @if ($item->status == 0) bg-light
                @elseif ($item->status == 1) bg-danger text-white 
                @elseif ($item->status == 2) bg-warning text-white
                @elseif ($item->status == 3) bg-info text-white
                @elseif ($item->status == 4) bg-dark text-white @endif">
										{{ $item->yard }}
									</div>

									<div class="text-center">
										<button class="btn btn-danger btn-xs mt-2" data-bs-toggle="modal"
											data-bs-target="#modalDelete{{ $item->id }}">
											<i class="bx bx-trash"></i>
										</button>
										@if (Auth()->user()->role === 'superadmin')
											<button class="btn btn-warning btn-xs mt-2" data-bs-toggle="modal"
												data-bs-target="#modalEdit{{ $item->id }}">
												<i class="bx bx-edit-alt"></i>
											</button>
										@endif
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
	{{-- Modal Tambah --}}
	<div class="modal fade" id="modalAdd" tabindex="-1" aria-modal="true">
		<div class="modal-dialog modal-sm modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white pb-3" id="modalAddTitle">Tambah Warna</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('pcs.store') }}" method="POST">
					@csrf
					<input type="hidden" name="warna_id" id="warna_id" value="{{ $warna->id }}">
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="yard" class="form-label">Yard</label>
								<input class="form-control @error('yard') is-invalid @enderror" type="text" id="yard" name="yard"
									value="{{ old('yard') }}" required autofocus />
								@error('yard')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-sm-6 mb-3">
								<label for="times" class="form-label">Times</label>
								<input class="form-control @error('times') is-invalid @enderror" type="number" id="times" name="times"
									value="{{ old('times') }}" required />
								@error('times')
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
						<button type="submit" class="btn btn-primary"><i class="bx bx-color-fill"></i> Tambah Pcs</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Modal Edit --}}

	@if (Auth()->user()->role == 'superadmin')
		@foreach ($pcs as $item)
			<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-modal="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header bg-warning pb-3">
							<h5 class="modal-title text-white" id="modalEditTitle">
								Edit Pcs
								<span class="text-black fw-bold">{{ $item->yard }}</span>
							</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="{{ route('pcs.update', $item->id) }}" method="POST">
							@csrf
							@method('put')
							<div class="modal-body">
								@if ($item->packingListNo)
									<div class="row">
										<div class="col-12">
											<small>Packing List No : <strong>{{ $item->packingListNo }}</strong></small>
										</div>
									</div>
									<hr>
								@endif
								<div class="row">
									<div class="col-sm-6 mb-3">
										<label for="yard" class="form-label">Yard</label>
										<input class="form-control @error('yard') is-invalid @enderror" type="text" id="yard"
											name="yard" value="{{ $item->yard }}" />
										@error('yard')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div class="col-sm-6 mb-3">
										<label for="status" class="form-label">Status</label>
										<select id="status" class="form-select @error('status') is-invalid @enderror" name="status"
											data-placeholder="--Pilih Status--" required style="width: 100%">
											<option value="" class="text-capitalize" hidden>--Pilih status--</option>
											<option value="" @if (!$item->status) selected @endif>Gudang Solo</option>
											<option value="1" @if ($item->status == 1) selected @endif>Stand</option>
											<option value="2" @if ($item->status == 2) selected @endif>Cabang</option>
											<option value="3" @if ($item->status == 3) selected @endif>Pembeli</option>
											<option value="4" @if ($item->status == 4) selected @endif>Online</option>
										</select>
										@error('status')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 mb-3">
										<label for="packingListNo" class="form-label">packingListNo</label>
										<input class="form-control @error('packingListNo') is-invalid @enderror" type="text" id="packingListNo"
											name="packingListNo" value="{{ old('packingListNo') }}" />
										@error('packingListNo')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
								<small>input at : {{ $item->input_at }}</small>
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
	@endif

	{{-- Modal Delete --}}
	@foreach ($pcs as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger pb-3">
						<h5 class="modal-title text-white" id="modalDeleteTitle">Delete Pieces</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('pcs.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4 class="alert-heading">Apakah anda yakin ingin menghapus data Kain</h4>
									<p><strong>{{ $item->yard }}</strong> ?</p>
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
		const cardEl = document.getElementById('sortable-cards');
		Sortable.create(cardEl);
	</script>

	{{-- <script>
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
	</script> --}}
@endpush
