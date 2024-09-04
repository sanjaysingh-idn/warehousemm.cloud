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
						<strong>Perhatian!</strong> Formulir kain keluar Otomatis digunakan jika <strong class="text-uppercase">data kain
							sudah ada</strong> di <a href="/kain"><i class="bx bx-link-external"></i> Daftar Kain</a>
					</div>
				</div>

				<div class="card-body">
					<form id="myForm" action="{{ route('packingList.store') }}" method="POST" enctype="multipart/form-data">
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
									{{-- <option value="Pusat Solo">Pusat Solo</option> --}}
									<option value="Stand">Stand</option>
									<option value="Cabang Kartasura">Cabang Kartasura</option>
									<option value="Cabang Ungaran">Cabang Ungaran</option>
									<option value="Cabang Salatiga">Cabang Salatiga</option>
									<option value="Cabang Beteng">Cabang Beteng</option>
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
								<label for="security" class="form-label">Security</label>
								<select id="security" class="form-select @error('security') is-invalid @enderror" name="nama_security"
									data-placeholder="--Pilih Security--" required style="width: 100%">
									<option value="" class="text-capitalize" hidden>--Pilih security--</option>
									@foreach ($security as $sp)
										<option value="{{ $sp->nama_security }}">{{ $sp->nama_security }}</option>
									@endforeach
								</select>
								@error('provinsi')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="koordinator" class="form-label">koordinator</label>
								<select id="koordinator" class="form-select @error('koordinator') is-invalid @enderror" name="nama_koordinator"
									data-placeholder="--Pilih koordinator--" required style="width: 100%">
									<option value="" class="text-capitalize" hidden>--Pilih koordinator--</option>
									@foreach ($koordinator as $sp)
										<option value="{{ $sp->nama_koordinator }}">{{ $sp->nama_koordinator }}</option>
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
							<div class="col-sm-12 mb-3">
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chooseProductModal">
									<i class="bx bxs-t-shirt me-2"></i> Pilih Kain
								</button>
								<div id="listProduct" class="my-2">

								</div>
								{{-- CART HERE --}}

								{{-- <label for="barang" class="form-label">Barang</label>
								<br>
								<textarea cols="20" name="barang" id="barang"></textarea>
								@error('barang')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror --}}
							</div>
							<div class="col-sm-12 mt-3">
								<button type="submit" class="btn btn-primary"><i class="bx bx-plus-circle"></i> Submit data keluar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--/ User Profile Content -->
@endsection

@push('modals')
	<!-- The modal structure -->
	<div class="modal fade" id="chooseProductModal" aria-labelledby="chooseProductModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="chooseProductModalLabel">Choose Product</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<!-- Add your form here to choose "kain" -> "warna" -> "pcs" -->
					<!-- Example: -->
					<form id="productSelectionForm">
						<div class="mb-3">
							<label for="kain" class="form-label">kain</label>
							<select id="kain" class="form-select @error('kain') is-invalid @enderror" name="kain"
								data-placeholder="--Pilih kain--" required style="width: 100%" onchange="updateWarnaOptions()">
								<option value="" class="text-capitalize" hidden>--Pilih kain--</option>
								@foreach ($kain as $k)
									<option value="{{ $k->id }}">
										{{ $k->nama_kain }} - @if ($k->kode_desain)
											[<span class="bold">{{ $k->kode_desain }}</span>]
										@else
											<small class="text-light">Tidak Ada Kode</small>
										@endif
										- {{ $k->supplier->nama_supplier }} - {{ \Carbon\Carbon::parse($k->tgl_masuk)->isoFormat('D MMMM Y') }}
									</option>
								@endforeach
							</select>
						</div>
						<div class="mb-3">
							<div class="alert alert-danger" role="alert">
								<strong>Perhatian!</strong> Jika Warna tidak ada di list. Maka Warna masih kosong dan harus ditambahkan di <a
									href="/kain">Daftar Kain</a>
							</div>

							<label for="warna">Warna</label>
							<select id="warna" class="form-select">

							</select>
						</div>
						<div class="mb-3">
							<div class="mb-3" id="pcsContainer">
								<!-- Dynamic input fields for "pcs" will be added here -->
							</div>
							{{-- <label for="pcs">Pcs</label>
							<select id="pcs" class="form-select">

							</select> --}}
						</div>
						<button type="button" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endpush

@push('scripts')
	<script>
		function updateWarnaOptions() {
			var selectedKain = document.getElementById('kain').value;
			var warnaDropdown = document.getElementById('warna');

			// Clear existing options
			warnaDropdown.innerHTML = '';

			// Add default option
			var defaultOption = document.createElement('option');
			defaultOption.text = '--Pilih warna--';
			defaultOption.value = '';
			warnaDropdown.add(defaultOption);

			// Make an AJAX request to fetch "warna" options based on the selected "kain"
			$.ajax({
				url: '/get-warna-options/' + selectedKain,
				type: 'GET',
				success: function(data) {
					// console.log(data); 

					$.each(data, function(index, item) {
						var option = document.createElement('option');
						option.text = item.nama_warna;
						option.value = item.id;
						warnaDropdown.add(option);
					});
				},
				error: function(error) {
					console.error('Error fetching "warna" options:', error);
				}
			});
		}


		function updatePcsOptions() {
			var pcsContainer = document.getElementById('pcsContainer');
			var selectedWarna = document.getElementById('warna').value;

			// Clear existing checkboxes and "Select All" button
			pcsContainer.innerHTML = '';

			// Make an AJAX request to fetch "pcs" options based on the selected "warna"
			$.ajax({
				url: '/get-pcs-options/' + selectedWarna,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'GET',
				success: function(data) {
					// Add "Select All" button
					var selectAllBtn = document.createElement('button');
					selectAllBtn.type = 'button';
					selectAllBtn.className = 'btn btn-success btn-xs mb-3';
					selectAllBtn.textContent = 'Select All';
					selectAllBtn.addEventListener('click', function() {
						// Set all checkboxes to checked when "Select All" is clicked
						var checkboxes = document.querySelectorAll('input[name="pcs[]"]');
						checkboxes.forEach(function(checkbox) {
							checkbox.checked = true;
						});
					});
					pcsContainer.appendChild(selectAllBtn);
					pcsContainer.appendChild(document.createElement('br'));

					// Add checkboxes for each "pcs" option
					$.each(data, function(key, value) {
						var pcsCheckbox = document.createElement('input');
						pcsCheckbox.type = 'checkbox';
						pcsCheckbox.className = 'form-check-input';
						pcsCheckbox.value = key;
						pcsCheckbox.name = 'pcs[]'; // Use an array for multiple "pcs" values

						// Set the 'yard' attribute for each checkbox
						pcsCheckbox.setAttribute('yard', value);

						var label = document.createElement('label');
						label.className = 'form-check-label';
						label.appendChild(pcsCheckbox);
						label.appendChild(document.createTextNode(' ' + value));

						pcsContainer.appendChild(label);
						pcsContainer.appendChild(document.createElement('br'));
					});
				},
				error: function(error) {
					console.error('Error fetching "pcs" options:', error);
				}
			});
		}

		function addToCart() {
			var selectedKain = document.getElementById('kain').options[document.getElementById('kain').selectedIndex].text;
			var getKainId = document.getElementById('kain').options[document.getElementById('kain').selectedIndex].value;
			var selectedWarna = document.getElementById('warna').options[document.getElementById('warna').selectedIndex].text;
			var getWarnaId = document.getElementById('warna').options[document.getElementById('warna').selectedIndex].value;

			var selectedPcs = [];
			var selectedPcsYard = [];

			var pcsCheckboxes = document.querySelectorAll('#pcsContainer input[type="checkbox"]:checked');
			pcsCheckboxes.forEach(function(checkbox) {
				selectedPcs.push({
					id: checkbox.value,
					quantity: checkbox.getAttribute('yard'),
				});
				selectedPcsYard.push(checkbox.getAttribute('yard'));
			});

			var cartItem = {
				id: 1,
				kain_keluar: [{
					id: getKainId,
					nama_kain: selectedKain,
					colors: [{
						id: getWarnaId,
						nama_warna: selectedWarna,
						pcs_keluar: selectedPcs,
					}, ],
				}, ],
			};

			var hiddenInput = document.createElement('input');
			hiddenInput.type = 'hidden';
			hiddenInput.name = 'listItem[]'; // Use an array for multiple items
			hiddenInput.value = JSON.stringify(cartItem);

			var form = document.getElementById('myForm');
			form.appendChild(hiddenInput);

			var listProduct = document.getElementById('listProduct');
			var listItem = document.createElement('div');
			listItem.className = 'mb-2';
			listItem.innerHTML =
				'<strong>' + cartItem.kain_keluar[0].nama_kain + '</strong> |' + cartItem.kain_keluar[0].colors[0]
				.nama_warna + ' | Yard: ' + selectedPcsYard.join(', ');
			// var deleteButton = document.createElement('button');
			// deleteButton.type = 'button';
			// deleteButton.className = 'btn btn-danger btn-xs ms-2';
			// deleteButton.textContent = 'Delete';
			// deleteButton.addEventListener('click', function() {
			// 	// Remove the corresponding listItem when the delete button is clicked
			// 	listItem.remove();
			// });

			// listItem.appendChild(deleteButton);
			listProduct.appendChild(listItem);

			document.getElementById('productSelectionForm').reset();
			$('#kain').trigger('change');
			// $('#chooseProductModal').modal('hide');
		}

		$(document).ready(function() {
			$('#kain').select2({
				dropdownParent: $("#chooseProductModal")
			});

			document.getElementById('warna').addEventListener('change', function() {
				updatePcsOptions();
			});

		});
	</script>
@endpush
