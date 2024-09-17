@extends('dashboard.layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
		<div class="col-12">
			<div class="card">
				<div class="card-header">
				</div>
				<div class="card-body">
					@foreach ($kategori as $kat)
						<a href="{{ url('/stoklama/' . $kat) }}" class="btn btn-primary m-2">
							{{ $kat }}
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!--/ User Profile Content -->
@endsection
