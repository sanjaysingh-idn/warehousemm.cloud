@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> <i class="bx bxs-t-shirt"></i>
			{{ $title }}
		</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Tambah Akun</button>
					</div>
				</div>

				<div class="card-body">
					<div class=" text-nowrap">
						<table id="table" class="table table-hover w-100">
							<caption class="ms-4">

							</caption>
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Jabatan</th>
									<th>Role</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($users as $item)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $item->name }}</td>
										<td>{{ $item->email }}</td>
										<td><i class="fab fa-angular fa-lg text-danger me-3"></i>
											<strong>{{ $item->jabatan }}</strong>
										</td>
										<td>
											@if ($item->role == 'superadmin')
												<span class="badge bg-label-primary me-1">{{ $item->role }}</span>
											@elseif ($item->role == 'manager')
												<span class="badge bg-label-success me-1">{{ $item->role }}</span>
											@elseif ($item->role == 'admin')
												<span class="badge bg-label-warning me-1">{{ $item->role }}</span>
											@elseif ($item->role == 'karyawan')
												<span class="badge bg-label-info me-1">{{ $item->role }}</span>
											@endif
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
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title text-white pb-3" id="modalAddTitle">Tambah Akun</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="name" class="form-label">Nama</label>
								<input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name"
									value="{{ old('name') }}" />
								@error('name')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="jabatan" class="form-label">Jabatan</label>
								<input class="form-control @error('jabatan') is-invalid @enderror" type="text" id="jabatan" name="jabatan"
									value="{{ old('jabatan') }}" />
								@error('jabatan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="email" class="form-label">Email</label>
								<input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email"
									value="{{ old('email') }}" />
								@error('email')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="password" class="form-label">password</label>
								<input class="form-control" type="password" id="password" name="password" />
							</div>
							<div class="col-sm-6 mb-3">
								<label for="role" class="form-label">role</label>
								<select id="role" class="select2 form-select @error('role') is-invalid @enderror" name="role" required>
									<option value="" class="text-capitalize">--Pilih Role--</option>
									@foreach ($role as $r)
										<option value="{{ $r }}" class="text-capitalize">{{ $r }}</option>
									@endforeach
								</select>
								@error('role')
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
	@foreach ($users as $item)
		<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning pb-3">
						<h5 class="modal-title text-white" id="modalEditTitle">
							Edit User
							<span class="text-black fw-bold">{{ $item->name }}</span>
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('user.update', $item->id) }}" method="POST">
						@csrf
						@method('put')
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-6 mb-3">
									<label for="name" class="form-label">Nama</label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name"
										value="{{ $item->name }}" />
									@error('name')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-6 mb-3">
									<label for="jabatan" class="form-label">Jabatan</label>
									<input class="form-control @error('jabatan') is-invalid @enderror" type="text" id="jabatan"
										name="jabatan" value="{{ $item->jabatan }}" />
									@error('jabatan')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-6 mb-3">
									<label for="email" class="form-label">Email</label>
									<input class="form-control @error('email') is-invalid @enderror" type="email" id="email"
										name="email" value="{{ $item->email }}" />
									@error('email')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-6 mb-3">
									<label for="password" class="form-label">Password</label>
									<input class="form-control" type="password" id="password" name="password" />
								</div>
								<div class="col-sm-6 mb-3">
									<label for="role" class="form-label">Role</label>
									<select id="role" class="select2 form-select @error('role') is-invalid @enderror" name="role"
										required>
										@foreach ($role as $r)
											@if (old('role', $item->role) == $r)
												<option value="{{ $r }}" class="text-capitalize" selected>{{ $r }}</option>
											@else
												<option value="{{ $r }}" class="text-capitalize">{{ $r }}</option>
											@endif
										@endforeach
									</select>
									@error('role')
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
	@foreach ($users as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger pb-3">
						<h5 class="modal-title text-white" id="modalDeleteTitle">Delete User</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('user.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4 class="alert-heading">Apakah anda yakin ingin menghapus data User</h4>
									<p><strong>{{ $item->name }}</strong> ?</p>
									<ul>
										<li>Jabatan : {{ $item->jabatan }}</li>
										<li>Role : {{ $item->role }}</li>
									</ul>
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

		document.addEventListener('DOMContentLoaded', function(e) {
			(function() {
				const deactivateAcc = document.querySelector('#formAccountDeactivation');

				// Update/reset user image of account page
				let accountUserImage = document.getElementById('uploadedAvatar');
				const fileInput = document.querySelector('.account-file-input'),
					resetFileInput = document.querySelector('.account-image-reset');

				if (accountUserImage) {
					const resetImage = accountUserImage.src;
					fileInput.onchange = () => {
						if (fileInput.files[0]) {
							accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
						}
					};
					resetFileInput.onclick = () => {
						fileInput.value = '';
						accountUserImage.src = resetImage;
					};
				}
			})();
		});
	</script>
@endpush
