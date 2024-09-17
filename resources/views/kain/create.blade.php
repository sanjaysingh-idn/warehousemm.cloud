@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					{{-- <div class="text-start mb-3">
						<a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bx bx-left-arrow-circle"></i> Kembali</a>
					</div> --}}
					<div class="text-start">
						Formulir untuk menambahkan data kain
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('kain.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-sm-6 mb-3 mt-3">
								<label for="surat_jalan" class="form-label">Surat Jalan</label>
								<input class="form-control @error('surat_jalan') is-invalid @enderror" type="text" id="surat_jalan"
									name="surat_jalan" value="{{ old('surat_jalan') }}" required />
								@error('surat_jalan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="lokasi" class="form-label">lokasi</label>
								<select id="lokasi" class="form-select @error('lokasi') is-invalid @enderror" name="lokasi"
									data-placeholder="--Pilih Lokasi--" required style="width: 100%">
									<option value="" class="text-capitalize" hidden>--Pilih Lokasi--</option>
									<option value="Gudang Solo">Gudang Solo</option>
									<option value="Gudang Kartasura">Gudang Kartasura</option>
								</select>
								@error('provinsi')
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
									<input type="checkbox" class="form-check-input @error('stok_lama') is-invalid @enderror" id="stok_lama"
										name="stok_lama" value="STOK LAMA" {{ old('stok_lama') == 'STOK LAMA' ? 'checked' : '' }}>
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
								<label for="kategori" class="form-label">Pilih Kategori</label>
								<select id="kategori" class="form-select @error('kategori') is-invalid @enderror" name="kategori" required>
									<option value="" hidden>--Pilih Kategori--</option>
									<option value="New" {{ old('kategori') == 'New' ? 'selected' : '' }}>New</option>
									<option value="Basic" {{ old('kategori') == 'Basic' ? 'selected' : '' }}>Basic</option>
									<option value="Broclade&Tulle" {{ old('kategori') == 'Broclade&Tulle' ? 'selected' : '' }}>Broclade&Tulle
									</option>
									<option value="Gent" {{ old('kategori') == 'Gent' ? 'selected' : '' }}>Gent</option>
									<option value="Ladys" {{ old('kategori') == 'Ladys' ? 'selected' : '' }}>Ladys</option>
									<option value="Batik" {{ old('kategori') == 'Batik' ? 'selected' : '' }}>Batik</option>
								</select>
								@error('kategori')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
								<input class="form-control @error('tgl_masuk') is-invalid @enderror" type="date" id="tgl_masuk"
									name="tgl_masuk" value="{{ old('tgl_masuk') }}" required />
								@error('tgl_masuk')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 mb-3 mt-3">
								<label for="nama_kain" class="form-label">Nama Kain</label>
								<input class="form-control @error('nama_kain') is-invalid @enderror" type="text" id="nama_kain"
									name="nama_kain" value="{{ old('nama_kain') }}" required />
								@error('nama_kain')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="kode_desain" class="form-label">Kode Desain</label>
								<input class="form-control @error('kode_desain') is-invalid @enderror" type="text" id="kode_desain"
									name="kode_desain" value="{{ old('kode_desain') }}" />
								@error('kode_desain')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="lot" class="form-label">Lot</label>
								<input class="form-control @error('lot') is-invalid @enderror" type="text" id="lot" name="lot"
									value="{{ old('lot') }}" />
								@error('lot')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="supplier" class="form-label">Supplier</label>
								<select id="supplier" class="form-select @error('supplier') is-invalid @enderror" name="supplier_id"
									data-placeholder="--Pilih Supplier--" required style="width: 100%">
									<option value="" class="text-capitalize" hidden>--Pilih Supplier--</option>
									@foreach ($supplier as $sp)
										<option value="{{ $sp->id }}">{{ $sp->nama_supplier }}</option>
									@endforeach
								</select>
								@error('provinsi')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="harga" class="form-label">Harga</label>
								<div class="input-group input-group-merge">
									<span class="input-group-text">Rp</span>
									<input type="number" min="0" class="form-control @error('harga') is-invalid @enderror"
										name="harga">
									@error('harga')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
							<div class="col-sm-6 mb-3">
								<label for="satuan" class="form-label">Satuan</label>
								<input class="form-control @error('satuan') is-invalid @enderror" type="text" id="satuan"
									name="satuan" value="{{ old('satuan') }}" oninput="this.value = this.value.toUpperCase()" />
								@error('satuan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12">
								<div class="alert alert-danger" role="alert">
									<strong>Untuk Kain Polos</strong> tetap di input & warna bebas
								</div>
								<label for="foto_kain" class="form-label">Foto Kain</label>
								<img id="preview" width="200" class="img-thumbnail mb-3">
								<label for="fileInput" class="btn btn-warning me-2 mb-4" tabindex="0">
									<span class="d-none d-sm-block">Upload Foto Desain</span>
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
								<button type="submit" class="btn btn-primary"><i class="bx bx-plus-circle"></i> Tambah Data</button>
								{{-- <div id="loadingIndicator" style="display: none;">
									Loading... <!-- You can customize this based on your design -->
								</div> --}}
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
			$('#supplier').select2();

			$('#kainForm').submit(function(event) {
				// Show loading spinner
				Swal.fire({
					title: 'Loading...',
					text: 'Please wait',
					allowOutsideClick: false,
					showCancelButton: false,
					showConfirmButton: false,
					onBeforeOpen: () => {
						Swal.showLoading();
					}
				});

				// Allow the form to be submitted
				return true;
			});
		});

		'use strict';

		function previewImage() {
			// Get the preview image element and the file input element
			var preview = document.getElementById("preview");
			var fileInput = document.getElementById("fileInput");

			// Check if a file was selected
			if (fileInput.files && fileInput.files[0]) {
				// Create a new FileReader object
				var reader = new FileReader();

				// Set the onload function for the reader
				reader.onload = function(e) {
					// Set the src attribute of the preview image to the result of the reader
					preview.setAttribute("src", e.target.result);
				};

				// Read the selected file as a data URL
				reader.readAsDataURL(fileInput.files[0]);
			} else {
				// If no file was selected, clear the preview image
				preview.setAttribute("src", "");
			}
		}

		function resetImage() {
			// Get the preview image element and the file input element
			var preview = document.getElementById("preview");
			var fileInput = document.getElementById("fileInput");

			// Clear the file input value and the preview image
			fileInput.value = "";
			preview.setAttribute("src", "");
		}
	</script>
@endpush
