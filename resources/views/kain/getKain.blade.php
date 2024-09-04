@extends('dashboard.layouts.main')

@section('content')
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-12">
					<div class="text-start mb-3">
						<a href="/kain" class="btn btn-secondary"><i class="bx bx-left-arrow-circle"></i> Kembali</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<img src="{{ public_path('image/logo.png') }}" alt="" srcset="" style="width: 80px"
						class="text-center mb-1">
					<h3>Mac Mohan Warehouse</h3>
					<p style="font-size: 14px">Jl. Gatot Subroto No.42, Kemlayan, Kec. Serengan, Kota Surakarta, Jawa Tengah 57151</p>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="head">
						<div class="row">
							<div class="col-12">
								<h3 class="text-center" style="margin-top: 0px !important;">
									ID: {{ $kain->id }}
								</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2">Nama Kain</div>
							<div class="col-lg-4">: <strong>{{ $kain->nama_kain }}</strong></div>
							<div class="col-lg-2">Masuk</div>
							<div class="col-lg-4">
								: <strong>{{ \Carbon\Carbon::parse($kain->tgl_masuk)->isoFormat('dddd, D MMMM Y') }}</strong>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2">Kode Desain</div>
							<div class="col-lg-4">: <strong>{{ $kain->kode_desain }}</strong></div>
							<div class="col-lg-2">Harga</div>
							<div class="col-lg-4">
								: <strong>{{ $kain->harga }}</strong> / {{ $kain->satuan }}</strong>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2">Lot</div>
							<div class="col-lg-4">: <strong>{{ $kain->lot }}</strong></div>
							<div class="col-lg-2">Pcs Total</div>
							<div class="col-lg-4">
								: <strong>{{ $kain->pcsCount() }} Pcs</strong> ({{ $kain->warnas->count() }} Warna)
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2">Supplier</div>
							<div class="col-lg-4">: <strong>{{ $kain->supplier->nama_supplier }}</strong></div>
							<div class="col-lg-2">Pcs Ready</div>
							<div class="col-lg-4">:<strong>
									@php
										$totalReadyPcs = 0;
										$warnaCount = 0;

										foreach ($kain->warnas as $item) {
										    $totalReadyPcs += $item->total_ready_pcs;

										    if ($item->total_ready_pcs > 0) {
										        $warnaCount++;
										    }
										}

										echo $totalReadyPcs;
									@endphp
									Pcs</strong> ( {{ $warnaCount }} Warna)
							</div>
						</div>
						@if ($kain->foto_kain)
							<div class="row mt-2">
								<div class="col-lg-12 text-center">
									@if ($kain->foto_kain)
										<div class="img mt-3">
											<img src="{{ public_path('storage/' . $kain->foto_kain) }}" alt="" srcset=""
												style="width: 60%;">
										</div>
									@else
										<div class="text-center text-center mt-3">
											<strong>Tidak Ada Foto Sampel</strong>
										</div>
									@endif
								</div>
							</div>
							<hr>
							<div class="page-break"></div>
						@endif
						<div class="row mt-3">
							<p>Keterangan Warna: <strong>{{ $kain->nama_kain }}</strong></p>
							<div class="col-lg-3">
								Masih Di Gudang
							</div>
							<div class="col-lg-3">
								<div class="square bg-light"></div>
							</div>
							<div class="col-lg-3">
								Keluar ke Stand
							</div>
							<div class="col-lg-3">
								<div class="square bg-danger"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								Keluar ke Cabang
							</div>
							<div class="col-lg-3">
								<div class="square bg-warning"></div>
							</div>
							<div class="col-lg-3">
								Keluar ke Pembeli
							</div>
							<div class="col-lg-3">
								<div class="square bg-info"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								Keluar ke Online
							</div>
							<div class="col-lg-3">
								<div class="square bg-dark"></div>
							</div>
						</div>
						<div class="row mt-3">
							<table class="table table-hover w-100 mt-2">
								<thead style="background-color: yellow; color: black;">
									<tr>
										<th>Kode Warna</th>
										<th>Pcs Ready</th>
										<th>Yard</th>
									</tr>
								</thead>
								<tbody>
									@php
										$no = 1;
									@endphp

									@php
										$sortedWarnas = $kain->warnas->sortBy(function ($item) {
										    return intval(preg_replace('/[^0-9]+/', '', $item->nama_warna));
										});
									@endphp

									@foreach ($sortedWarnas as $item)
										<tr class="align-top @if ($item->total_ready_pcs == 0) bg-success @endif">
											<td>
												{{ $item->nama_warna }}
												<br>
												<span class="badge bg-primary">{{ $item->nama_desain }}</span>
											</td>
											<td>
												{{ $item->total_ready_pcs }} Pcs
											</td>
											<td>
												<div>
													@foreach ($item->pcs as $pcs)
														<span
															class="square p-1 shadow mx-auto text-center
                            @if ($pcs->status == 0) bg-light
                            @elseif ($pcs->status == 1) bg-danger text-white 
                            @elseif ($pcs->status == 2) bg-warning text-white
                            @elseif ($pcs->status == 3) bg-info text-white
                            @elseif ($pcs->status == 4) bg-dark text-white @endif
                        ">
															{{ $pcs->yard }}
														</span>
													@endforeach
												</div>
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
	</div>
@endsection
