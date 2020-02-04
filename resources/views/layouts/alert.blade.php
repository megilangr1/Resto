<div class="col-md-12">
		@if (session('success'))
		<div class="alert alert-success alert-dismissible fade show flat" role="alert">
			<strong>Berhasil !</strong> <br>
			{{ session('success') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	@if (session('danger'))
		<div class="alert alert-danger alert-dismissible fade show flat" role="alert">
			<strong>Pemberitahuan !</strong> <br>
			{{ session('danger') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
</div>