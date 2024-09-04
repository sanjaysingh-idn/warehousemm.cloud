@if (session()->has('message'))
	{{-- <div class="bs-toast toast toast-placement-ex m-2 fade bg-success top-0 start-50 translate-middle-x show" role="alert"
		aria-live="assertive" aria-atomic="true" data-delay="2000">
		<div class="toast-header">
			<i class="bx bx-check-circle me-2"></i>
			<div class="me-auto fw-semibold">Berhasil!</div>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">{{ session()->get('message') }}</div>
	</div> --}}
	{{-- @elseif (session()->has('message_verifikasi'))
	<div class="bs-toast toast toast-placement-ex m-2 fade bg-primary top-0 start-50 translate-middle-x show" role="alert"
		aria-live="assertive" aria-atomic="true" data-delay="2000">
		<div class="toast-header">
			<i class="bx bx-check-circle me-2"></i>
			<div class="me-auto fw-semibold">Berhasil!</div>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">{{ session()->get('message_verifikasi') }}</div>
	</div> --}}
	{{-- @elseif (session()->has('message_delete')) --}}
	{{-- <div class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show" role="alert"
		aria-live="assertive" aria-atomic="true" data-delay="2000">
		<div class="toast-header">
			<i class="bx bx-check-circle me-2"></i>
			<div class="me-auto fw-semibold">Berhasil!</div>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">{{ session()->get('message_delete') }}</div>
	</div> --}}
@elseif (session()->has('message_peserta'))
	<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show" role="alert"
		aria-live="assertive" aria-atomic="true" data-delay="2000">
		<div class="toast-header">
			<i class="bx bx-x-circle me-2"></i>
			<div class="me-auto fw-semibold">Input Gagal!</div>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">{{ session()->get('message_peserta') }}</div>
	</div>
@elseif (session()->has('message_noaccess'))
	<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show" role="alert"
		aria-live="assertive" aria-atomic="true" data-delay="2000">
		<div class="toast-header">
			<i class="bx bx-x-circle me-2"></i>
			<div class="me-auto fw-semibold">Anda tidak memiliki kesini</div>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">{{ session()->get('message_noaccess') }}</div>
	</div>
@endif
