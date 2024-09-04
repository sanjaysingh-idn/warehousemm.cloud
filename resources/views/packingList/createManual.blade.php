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
						Formulir untuk menambahkan data kain keluar
					</div>
					<div class="alert alert-danger mt-2" role="alert">
						<strong>Perhatian!</strong> Formulir kain keluar manual digunakan jika <strong class="text-uppercase">data kain
							belum ada</strong> di <a href="/kain"><i class="bx bx-link-external"></i> Daftar Kain</a>
					</div>
				</div>

				<div class="card-body">
					<form id="myForm" action="{{ route('packingList.storeManual') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-sm-4 mb-3">
								<label for="jenis" class="form-label"><strong>jenis packing list</strong></label>
								<select id="jenis" class="form-select @error('jenis') is-invalid @enderror" name="jenis"
									data-placeholder="--Pilih jenis--" required style="width: 100%">
									<option value="" class="text-capitalize" hidden>--Pilih jenis--</option>
									<option value="Basic">Basic / Best Seller</option>
									<option value="Gent">Gent</option>
									<option value="Brocade/Tule">Brocade / Tule</option>
									<option value="Ladys">Ladys</option>
									<option value="Cabang">Cabang</option>
									<option value="Grosir">Grosir</option>
								</select>
								@error('jenis')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 mb-3">
								<label for="tanggal" class="form-label">Tanggal</label>
								<input class="form-control @error('tanggal') is-invalid @enderror" type="date" id="tanggal" name="tanggal"
									value="{{ old('tanggal') }}" required />
								@error('tanggal')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="nama_pengambil" class="form-label">Nama Pengambil</label>
								<input class="form-control @error('nama_pengambil') is-invalid @enderror" type="text" id="nama_pengambil"
									name="nama_pengambil" value="{{ old('nama_pengambil') }}" required />
								@error('nama_pengambil')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="tujuan" class="form-label">tujuan</label>
								<select id="tujuan" class="form-select @error('tujuan') is-invalid @enderror" name="tujuan"
									data-placeholder="--Pilih tujuan--" required style="width: 100%">
									<option value="" class="text-capitalize" hidden>--Pilih tujuan--</option>
									<option value="Pusat Solo">Pusat Solo</option>
									<option value="Cabang Kartasura">Cabang Kartasura</option>
									<option value="Cabang Ungaran">Cabang Ungaran</option>
									<option value="Cabang Salatiga">Cabang Salatiga</option>
									<option value="Cabang Beteng">Cabang Beteng</option>
									<option value="Stand">Stand</option>
									<option value="Online">Online</option>
									<option value="Pembeli">Pembeli</option>
								</select>
								@error('tujuan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="nama_security" class="form-label">Nama Security</label>
								<input class="form-control @error('nama_security') is-invalid @enderror" type="text" id="nama_security"
									name="nama_security" value="{{ old('nama_security') }}" required />
								@error('nama_security')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="nama_koordinator" class="form-label">Nama Koordinator</label>
								<input class="form-control @error('nama_koordinator') is-invalid @enderror" type="text" id="nama_koordinator"
									name="nama_koordinator" value="{{ old('nama_koordinator') }}" required />
								@error('nama_koordinator')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="total_pcs" class="form-label">Total Pcs</label>
								<input class="form-control @error('total_pcs') is-invalid @enderror" type="text" id="total_pcs"
									name="total_pcs" value="{{ old('total_pcs') }}" required />
								@error('total_pcs')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row">

							<div class="col-sm-12 mb-3">
								<label for="barang" class="form-label">Barang</label>
								<br>
								<textarea cols="20" name="barang" id="barang"></textarea>
								@error('barang')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mt-3">
								<button type="submit" class="btn btn-primary"><i class="bx bx-plus-circle"></i> Tambah Data</button>
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
	<script src="https://cdn.tiny.cloud/1/a0g7gmopfw6dinotme1swxtg4ell4rctxdxtw8rdzrpvbyqx/tinymce/6/tinymce.min.js"
		referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: 'textarea#barang',
			plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
			toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
			tinycomments_mode: 'embedded',
			tinycomments_author: 'Author name',
			mergetags_list: [{
					value: 'First.Name',
					title: 'First Name'
				},
				{
					value: 'Email',
					title: 'Email'
				},
			],
			ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
				"See docs to implement AI Assistant")),
		});
	</script>
@endpush
