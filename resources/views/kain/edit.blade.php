@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="text-start mb-3">
						<a href="/kain" class="btn btn-secondary"><i class="bx bx-left-arrow-circle"></i> Kembali</a>
					</div>
					<div class="text-start">
						Formulir untuk mengubah data kain
					</div>
				</div>
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<div class="card-body">
					<form action="{{ route('kain.update', $kain->id) }}" method="POST" enctype="multipart/form-data">
						@method('put')
						@csrf
						<div class="row">
							<div class="col-sm-6 mb-3 mt-3">
								<label for="surat_jalan" class="form-label">Surat Jalan</label>
								<input class="form-control @error('surat_jalan') is-invalid @enderror" type="text" id="surat_jalan"
									name="surat_jalan" value="{{ $kain->surat_jalan }}" required />
								@error('surat_jalan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="lokasi" class="form-label">lokasi</label>
								<select id="lokasi" class="form-select @error('lokasi') is-invalid @enderror" name="lokasi"
									data-placeholder="--Pilih Lokasi--" required style="width: 100%">
									<option value="" class="text-capitalize" hidden>--Pilih Lokasi--</option>
									<option value="Gudang Solo" {{ $kain->lokasi == 'Gudang Solo' ? 'selected' : '' }}>Gudang Solo</option>
									<option value="Gudang Kartasura" {{ $kain->lokasi == 'Gudang Kartasura' ? 'selected' : '' }}>Gudang Kartasura
									</option>
								</select>
								@error('lokasi')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="stok_lama" class="form-label">Stok Lama</label>
								<div class="form-check">
									<!-- Hidden input to set stok_lama to null if unchecked -->
									<input type="hidden" name="stok_lama" value="">

									<!-- Checkbox for stok_lama -->
									<input type="checkbox" class="form-check-input @error('stok_lama') is-invalid @enderror" id="stok_lama"
										name="stok_lama" value="STOK LAMA"
										{{ old('stok_lama', $kain->stok_lama ?? '') == 'STOK LAMA' ? 'checked' : '' }}>
									<label class="form-check-label" for="stok_lama">Centang jika ini Stok Lama</label>
								</div>
								@error('stok_lama')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="nama_kain" class="form-label">Nama Kain</label>
								<input class="form-control @error('nama_kain') is-invalid @enderror" type="text" id="nama_kain"
									name="nama_kain" value="{{ $kain->nama_kain }}" />
								@error('nama_kain')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="kode_desain" class="form-label">Kode Desain</label>
								<input class="form-control @error('kode_desain') is-invalid @enderror" type="text" id="kode_desain"
									name="kode_desain" value="{{ $kain->kode_desain }}" />
								@error('kode_desain')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="lot" class="form-label">Lot</label>
								<input class="form-control @error('lot') is-invalid @enderror" type="text" id="lot" name="lot"
									value="{{ $kain->lot }}" />
								@error('lot')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="harga" class="form-label">Harga</label>
								<div class="input-group input-group-merge">
									<span class="input-group-text">Rp</span>
									<input type="number" value="{{ $kain->harga }}" min="0"
										class="form-control @error('harga') is-invalid @enderror" name="harga">
									@error('harga')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
							<div class="col-sm-6 mb-3">
								<label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
								<input class="form-control @error('tgl_masuk') is-invalid @enderror" type="date" id="tgl_masuk"
									name="tgl_masuk" value="{{ old('tgl_masuk', $kain->tgl_masuk ?? '') }}" required />
								@error('tgl_masuk')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="satuan" class="form-label">Satuan</label>
								<input class="form-control @error('satuan') is-invalid @enderror" type="text" id="satuan"
									name="satuan" value="{{ $kain->satuan }}" />
								@error('satuan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="p" class="form-label">keterangan</label>
								<input class="form-control @error('keterangan') is-invalid @enderror" type="text" id="keterangan"
									name="keterangan" value="{{ $kain->keterangan }}" />
								@error('keterangan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="supplier" class="form-label">Supplier</label>
								<select id="supplier" class="form-select @error('supplier_id') is-invalid @enderror" name="supplier_id"
									data-placeholder="--Pilih Supplier--" required style="width: 100%">
									<option value="" class="text-capitalize" hidden>--Pilih Supplier--</option>
									@foreach ($supplier as $sp)
										@if ($sp->id == old('supplier_id', $kain->supplier_id))
											<option value="{{ $sp->id }}" class="text-capitalize" selected>{{ $sp->nama_supplier }}</option>
										@else
											<option value="{{ $sp->id }}" class="text-capitalize">{{ $sp->nama_supplier }}</option>
										@endif
									@endforeach
								</select>
								@error('supplier_id')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12">
								<label for="kain_lama" class="form-label">Foto kain lama</label>
								<img src="{{ asset('storage/' . $kain->foto_kain) }}" width="200" class="img-thumbnail mb-3">
								<div class="alert alert-danger" role="alert">
									<strong>Untuk Kain Polos</strong> tetap di input & warna bebas
								</div>
								<label for="kode_spd" class="form-label">Foto kain</label>
								<img id="preview" width="200" class="img-thumbnail mb-3">
								<label for="fileInput" class="btn btn-warning me-2 mb-4" tabindex="0">
									<span class="d-none d-sm-block">Upload Foto kain</span>
									<i class="bx bx-upload d-block d-sm-none"></i>
									<input type="file" class="account-file-input @error('foto_kain') is-invalid @enderror" id="fileInput"
										name="foto_kain" accept="image/png, image/jpeg" hidden onchange="previewImage()">
								</label>
								<button type="button" value="Reset" onclick="resetImage()"
									class="btn btn-outline-warning account-image-reset mb-4">
									<i class="bx bx-reset d-block d-sm-none"></i>
									<span class="d-none d-sm-block">Reset</span>
								</button>
								@error('foto_kain')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
								<p class="text-muted mb-0">Format JPG, PNG, JPEG, PDF Ukuran Max 2MB</p>
							</div>
							<div class="col-sm-12">
								<hr>
								<button type="submit" class="btn btn-primary"><i class="bx bx-edit-alt"></i> Edit Data</button>
							</div>
						</div>
					</form>
				</div>
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
			});
		});

		'use strict';

		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
			$('#supplier').select2();
		});
	</script>
@endpush
