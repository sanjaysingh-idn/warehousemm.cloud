<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo py-5 my-3 mx-auto" style="height: 100px;">
		<img src="{{ asset('template/assets/img/favicon') }}/logo-hitam.png" alt="Logo Mac Mohan" class="img-thumbnail"
			width="100px">

		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<!-- Dashboard -->
		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">WMS Mac Mohan</span>
		</li>
		<li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
			<a href="/dashboard" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div>Dashboard</div>
			</a>
		</li>

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">In / Out</span>
		</li>
		<li class="menu-item {{ request()->is('kain/create') ? 'active open' : '' }}">
			<a href="/kain/create" class="menu-link">
				<i class='menu-icon tf-icons bx bx-right-arrow-alt'></i>
				<div>Barang Masuk</div>
			</a>
		</li>
		<li class="menu-item {{ request()->is('packingList/create') ? 'active open' : '' }}">
			<a href="/packingList/create" class="menu-link">
				<i class='menu-icon tf-icons bx bx-left-arrow-alt'></i>
				<div>Barang Keluar (Otomatis)</div>
			</a>
		</li>
		{{-- <li class="menu-item {{ request()->is('packingList/createManual') ? 'active open' : '' }}">
			<a href="/packingList/createManual" class="menu-link">
				<i class='menu-icon tf-icons bx bx-left-arrow-alt'></i>
				<div>Barang Keluar (Manual)</div>
			</a>
		</li> --}}

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">Master</span>
		</li>
		<li
			class="menu-item {{ request()->is('kain', 'kain/*') && !request()->is('kain/create', 'kain/keluar', 'kain/keluar/create') ? 'active open' : '' }}">
			<a href="/kain" class="menu-link">
				<i class='menu-icon tf-icons bx bxs-t-shirt'></i>
				<div>Daftar Kain</div>
			</a>
		</li>

		<li
			class="menu-item {{ request()->is('stoklama', 'stoklama/*') && !request()->is('stoklama/create', 'stoklama/keluar', 'stoklama/keluar/create') ? 'active open' : '' }}">
			<a href="/stoklama" class="menu-link">
				<i class='menu-icon tf-icons bx bxl-medium-old'></i>
				<div>Kain Stok Lama</div>
			</a>
		</li>

		<li
			class="menu-item {{ request()->is('packingList', 'packingList/*') && !request()->is('packingList/create', 'packingList/createManual') ? 'active open' : '' }}">
			<a href="/packingList" class="menu-link">
				<i class='menu-icon tf-icons bx bx-list-check'></i>
				<div>Daftar Packing List</div>
			</a>
		</li>

		<li class="menu-item {{ request()->is('supplier') ? 'active open' : '' }}">
			<a href="/supplier" class="menu-link">
				<i class='menu-icon tf-icons bx bx-home-circle'></i>
				<div>Supplier</div>
			</a>
		</li>
		<li class="menu-item {{ request()->is('bukutamu') ? 'active open' : '' }}">
			<a href="/bukutamu" class="menu-link">
				<i class='menu-icon tf-icons bx bxs-user-rectangle'></i>
				<div>Buku Tamu</div>
			</a>
		</li>
		<li class="menu-item {{ request()->is('security') ? 'active open' : '' }}">
			<a href="/security" class="menu-link">
				<i class='menu-icon tf-icons bx bx-user-voice'></i>
				<div>Security</div>
			</a>
		</li>
		<li class="menu-item {{ request()->is('koordinator') ? 'active open' : '' }}">
			<a href="/koordinator" class="menu-link">
				<i class='menu-icon tf-icons bx bxs-user-detail'></i>
				<div>Koordinator</div>
			</a>
		</li>
		<li class="menu-item {{ request()->is('driver') ? 'active open' : '' }}">
			<a href="/driver" class="menu-link">
				<i class='menu-icon tf-icons bx bxs-truck'></i>
				<div>Driver</div>
			</a>
		</li>

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">Laporan</span>
		</li>
		<li class="menu-item {{ request()->is('laporanKain', 'laporanKain/*') ? 'active open' : '' }}">
			<a href="/laporanKain" class="menu-link">
				<i class='menu-icon tf-icons bx bxs-report'></i>
				<div>Laporan Barang Masuk</div>
			</a>
		</li>
		<li class="menu-item {{ request()->is('laporanPackingList', 'laporanPackingList/*') ? 'active open' : '' }}">
			<a href="/laporanPackingList" class="menu-link">
				<i class='menu-icon tf-icons bx bxs-report'></i>
				<div>Laporan Packing List</div>
			</a>
		</li>
		<li class="menu-item {{ request()->is('laporanTamu', 'laporanTamu/*') ? 'active open' : '' }}">
			<a href="/laporanTamu" class="menu-link">
				<i class='menu-icon tf-icons bx bxs-report'></i>
				<div>Laporan Buku Tamu</div>
			</a>
		</li>
		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">SETTING</span>
		</li>
		<li class="menu-item {{ request()->is('user') ? 'active' : '' }}">
			<a href="/user" class="menu-link">
				<i class="menu-icon tf-icons bx bxs-user-account"></i>
				<div>Users</div>
			</a>
		</li>
		<li class="menu-item {{ request()->is('/pengajuan/index') ? 'active' : '' }}">
			<a href="/pengajuan/index" class="menu-link">
				<i class="menu-icon tf-icons bx bxs-face-mask"></i>
				<div>Pengajuan</div>
			</a>
		</li>
		@if (Auth::check() && Auth::user()->name === 'Sanjay Singh')
			<li class="menu-item">
				<a href="{{ route('backup.database') }}" class="menu-link">
					<i class="menu-icon tf-icons bx bx-data"></i>
					<div>Backup Database</div>
				</a>
			</li>
		@endif
		{{-- <li class="menu-item {{ request()->is('/pengajuan/index') ? 'active' : '' }}">
			<a href="/pengajuan/index" class="menu-link">
				<i class="menu-icon tf-icons bx bxs-face-mask"></i>
				<div>Pengajuan</div>
			</a>
		</li> --}}

	</ul>
</aside>
<!-- / Menu -->
