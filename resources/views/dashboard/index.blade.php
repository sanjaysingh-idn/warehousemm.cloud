@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<div class="col-12 mb-4 order-0">
			<div class="card">
				<div class="d-flex align-items-end row">
					<div class="col-sm-7">
						<div class="card-body">
							<h5 class="card-title text-warning">Selamat Datang</h5>
							<p>
								<small><i class="bx bx-user"></i> {{ Auth::user()->name }}</small>
							</p>
							<p>
								<small class="text-capitalize"><strong>{{ Auth::user()->role }}</strong></small>
							</p>
							<p class="mb-4">
								Ini adalah halaman dashboard <strong class="text-warning">Warehouse Management System</strong> Mac Mohan
							</p>
						</div>
					</div>
					<div class="col-sm-5 text-center text-sm-left">
						<div class="card-body pb-0 px-0 px-md-4">
							<img src="{{ asset('template') }}/assets/img/illustrations/girl-doing-yoga-light.png" height="140"
								alt="View Badge User" data-app-dark-img="illustrations/girl-doing-yoga-light.png"
								data-app-light-img="illustrations/girl-doing-yoga-light.png" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-sm-6 mb-1">
			<div class="card">
				<div class="card-body">
					<div class="card-title d-flex align-items-start justify-content-between">
						<div class="avatar flex-shrink-0">
							<span class="avatar-initial rounded bg-label-primary">
								<i class="bx bx-right-arrow-alt"></i>
							</span>
						</div>
						<div class="dropdown">
							<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">
								<i class="bx bx-dots-vertical-rounded"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
								<a class="dropdown-item" href="/packingList">View More</a>
							</div>
						</div>
					</div>
					<span class="fw-medium d-block mb-1">Kain Masuk Hari ini</span>
					<h3 class="card-title mb-2">{{ $countKainToday }}</h3>
					{{-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> --}}
				</div>
			</div>
		</div>
		<div class="col-sm-6 mb-1">
			<div class="card">
				<div class="card-body">
					<div class="card-title d-flex align-items-start justify-content-between">
						<div class="avatar flex-shrink-0">
							<span class="avatar-initial rounded bg-label-warning">
								<i class="bx bx-left-arrow-alt"></i>
							</span>
						</div>
						<div class="dropdown">
							<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">
								<i class="bx bx-dots-vertical-rounded"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
								<a class="dropdown-item" href="/packingList">View More</a>
							</div>
						</div>
					</div>
					<span class="fw-medium d-block mb-1">Kain Keluar Hari ini</span>
					<h3 class="card-title mb-2">{{ $countPackingList }}</h3>
					{{-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> --}}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 mb-1">
			<div class="row">
				<div class="col-sm-6 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="avatar flex-shrink-0">
									<span class="avatar-initial rounded bg-label-danger">
										<i class="bx bxs-t-shirt"></i>
									</span>
								</div>
								<div class="dropdown">
									<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
										<a class="dropdown-item" href="/kain">View More</a>
									</div>
								</div>
							</div>
							<span class="fw-medium d-block mb-1">Jumlah Data Kain</span>
							<h3 class="card-title mb-2">{{ $countKain }}</h3>
							<br>
							<p>Total Pcs Ready : {{ $countNullStatusPcs }}</p>
							{{-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> --}}
						</div>
					</div>
				</div>
				<div class="col-sm-6 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="avatar flex-shrink-0">
									<span class="avatar-initial rounded bg-label-info">
										<i class="bx bx-home-circle"></i>
									</span>
								</div>
								<div class="dropdown">
									<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
										<a class="dropdown-item" href="/packingList">View More</a>
									</div>
								</div>
							</div>
							<span class="fw-medium d-block mb-1">Jumlah Supplier</span>
							<h3 class="card-title mb-2">{{ $countSupplier }}</h3>
							{{-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> --}}
						</div>
					</div>
				</div>
				<div class="col-sm-6 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="avatar flex-shrink-0">
									<span class="avatar-initial rounded bg-label-dark">
										<i class="bx bxs-user-rectangle"></i>
									</span>
								</div>
								<div class="dropdown">
									<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
										<a class="dropdown-item" href="/packingList">View More</a>
									</div>
								</div>
							</div>
							<span class="fw-medium d-block mb-1">Buku Tamu</span>
							<h3 class="card-title mb-2">{{ $countSupplier }}</h3>
							{{-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> --}}
						</div>
					</div>
				</div>
				<div class="col-sm-6 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="avatar flex-shrink-0">
									<span class="avatar-initial rounded bg-label-success">
										<i class="bx bxs-truck"></i>
									</span>
								</div>
								<div class="dropdown">
									<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
										<a class="dropdown-item" href="/bukutamu">View More</a>
									</div>
								</div>
							</div>
							<span class="fw-medium d-block mb-1">Notebook Driver</span>
							<h3 class="card-title mb-2">{{ $countBukutamu }}</h3>
							{{-- <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i></small> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 mb-1">
			<div class="card h-100">
				<div class="card-header d-flex align-items-center justify-content-between pb-3 bg-primary text-white">
					<div class="card-title mb-0">
						<h5 class="m-0 me-2 text-white">Data Kain Keluar Terbaru</h5>
					</div>
					<div class="dropdown">
						<button class="btn p-0 text-white" type="button" id="orederStatistics" data-bs-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false">
							<i class="bx bx-dots-vertical-rounded"></i>
						</button>
						<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
							<a class="dropdown-item" href="javascript:void(0);">Select All</a>
							<a class="dropdown-item" href="javascript:void(0);">Refresh</a>
							<a class="dropdown-item" href="javascript:void(0);">Share</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-3" style="position: relative;">
						<div class="d-flex flex-column align-items-center gap-1">

						</div>
						<div class="resize-triggers">
							<div class="expand-trigger">
								<div style="width: 318px; height: 139px;"></div>
							</div>
							<div class="contract-trigger"></div>
						</div>
					</div>
					<div class="row">
						@foreach ($packingList as $pl)
							<div class="col-sm-3">
								<p
									class="@if ($pl->jenis == 'Brocade/Tule') bg-success text-black fw-bold text-center
        									@elseif($pl->jenis == 'Basic') bg-primary text-white fw-bold text-center
        									@elseif($pl->jenis == 'Gent') bg-danger text-white fw-bold text-center
        									@elseif($pl->jenis == 'Grosir') bg-info text-white fw-bold text-center
        									@elseif($pl->jenis == 'Cabang') bg-warning text-white fw-bold text-center
        									@elseif($pl->jenis == 'Ladys') bg-dark text-white fw-bold text-center @endif">
									{{ $pl->jenis }}
								</p>
							</div>
							<div class="col-sm-3">
								<p class="mb-0">{{ $pl->packingListNo }}</p>
							</div>
							<div class="col-sm-3">
								<p class="">{{ $pl->nama_pengambil }}</p>
							</div>
							<div class="col-sm-3">
								<p class="">{{ $pl->total_pcs }} Pcs</p>
							</div>
							<hr>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="row">
		<div class="col-12">
			<h3 style="letter-spacing: 3px"><strong>TOTAL BIAYA PERJALANAN DINAS</strong></h3>
			<div class="row">
				<div class="col-sm-6 mb-4">
					<div class="card rounded">
						<div class="card-body bg-primary text-white">
							<span class="fw-semibold d-block mb-1">TOTAL TAHUNAN - {{ date('Y') }}</span>
							<h2 class="card-title mb-2 fw-bold text-white my-4">Rp. 0</h2>
							@if (Auth::user()->role !== 'pegawai')
								<small class="text-primary fw-semibold">
									<a href="/user" class="btn btn-light btn-sm text-decoration-none text-primary mt-4"><i
											class="bx bx-subdirectory-right"></i> Laporan</a>
								</small>
							@endif
						</div>
					</div>
				</div>
				<div class="col-sm-6 mb-4">
					<div class="card">
						<div class="card-body bg-dark text-white">
							<span class="fw-semibold d-block mb-1">TOTAL BULANAN - {{ date('F') }}</span>
							<h2 class="card-title mb-2 fw-bold text-white my-4">Rp. 0</h2>
							@if (Auth::user()->role !== 'pegawai')
								<small class="text-primary fw-semibold">
									<a href="/user" class="btn btn-light btn-sm text-decoration-none text-primary mt-4"><i
											class="bx bx-subdirectory-right"></i> Laporan</a>
								</small>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			<h3 style="letter-spacing: 3px"><strong>PERJALANAN DINAS</strong></h3>
			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="flex-shrink-0">
									<div class="alert-primary rounded text-center p-1">
										<i class="bx bx-subdirectory-right text-primary fs-3"></i>
									</div>
								</div>
							</div>
							<span class="fw-semibold d-block mb-1">SPD USULAN</span>
							<h3 class="card-title mb-2"></h3>

						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="flex-shrink-0">
									<div class="alert-success rounded text-center p-1">
										<i class="bx bx-check-circle text-success fs-3"></i>
									</div>
								</div>
							</div>
							<span class="fw-semibold d-block mb-1">SPD VERIFIKASI</span>
							<h3 class="card-title mb-2"></h3>

						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="flex-shrink-0">
									<div class="alert-danger rounded text-center p-1">
										<i class="bx bxs-plane-alt text-danger fs-3"></i>
									</div>
								</div>
							</div>
							<span class="fw-semibold d-block mb-1">SPD BERJALAN</span>
							<h3 class="card-title mb-2"></h3>

						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="flex-shrink-0">
									<div class="alert-dark rounded text-center p-1">
										<i class="bx bxs-plane-land text-dark fs-3"></i>
									</div>
								</div>
							</div>
							<span class="fw-semibold d-block mb-1">SPD SELESAI</span>
							<h3 class="card-title mb-2"></h3>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			<h3 style="letter-spacing: 3px"><strong>PEGAWAI</strong></h3>
			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="flex-shrink-0">
									<div class="alert-primary rounded text-center p-1">
										<i class="bx bxs-plane-take-off text-primary fs-3"></i>
									</div>
								</div>
							</div>
							<span class="fw-semibold d-block mb-1">PEGAWAI DALAM PERJALANAN</span>
							<h4 class="card-title mb-2"> <small>Orang</small></h4>

						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="flex-shrink-0">
									<div class="alert-success rounded text-center p-1">
										<i class="bx bx-user-circle text-success fs-3"></i>
									</div>
								</div>
							</div>
							<span class="fw-semibold d-block mb-1">TOTAL PEGAWAI</span>
							<h3 class="card-title mb-2"></h3>

						</div>
					</div>
				</div>
				@if (Auth::user()->role !== 'pegawai')
					{{-- <div class="col-lg-6 col-md-4 col-sm-12 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">SPD TERBARU</h5>
                            <small class="text-muted">Total : 2 Spd</small>
                        </div>
                    </div>
                    <div class="card-body mt-4">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Electronic</h6>
                                        <small class="text-muted">Mobile, Earbuds, TV</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">82.5k</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Fashion</h6>
                                        <small class="text-muted">T-shirt, Jeans, Shoes</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">23.8k</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Decor</h6>
                                        <small class="text-muted">Fine Art, Dining</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">849k</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-football"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Sports</h6>
                                        <small class="text-muted">Football, Cricket Kit</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">99</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
	{{-- </div>
	</div>
	</div> --}}

	</div>
@endsection
