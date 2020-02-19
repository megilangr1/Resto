@extends('layouts.app')

@section('content')
<div class="col-12 mb-2">
	<h4>Manajemen Data Supplier</h4>
</div>
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
<div class="col-12">
	<div class="card flat">
		<div class="card-header">
			<div class="row">
				<div class="col-md-6">
					Data Supplier
				</div>
				<div class="col-md-6 text-right">
					<a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm">
						Tambah Data Supplier
					</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				{{ $dataTable->table() }}
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
	{{ $dataTable->scripts() }}
@endpush