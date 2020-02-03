@extends('layouts.app')

@section('content')
<div class="col-md-12 mb-2">
	<h4>Management Level Akses Pengguna</h4>
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
<div class="col-md-5">
	<div class="card flat">
		<div class="card-header flat">
			Form Level Akses
		</div>
		<div class="card-body flat">
			<form action="{{ route('role.store') }}" method="post">
				@csrf
				<div class="form-group">
					<label for="">Nama Level : </label>
					<input type="text" name="name" id="name" class="form-control flat {{ $errors->has('name') ? 'is-invalid':'' }}" autocomplete="off" autofocus required value="{{ old('name') }}">
					<p class="text-danger text-sm">
						{{ $errors->first('name') }}
					</p>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-sm flat">
						Tambah Data
					</button>
					<button type="reset" class="btn btn-danger btn-sm flat">
						Reset Input
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-md-7">
	<div class="card flat">
		<div class="card-header flat">
			Data Level Akses
		</div>
		<div class="card-body flat">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Guard</th>
							<th width="30%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($roles as $item)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->guard_name }}</td>
								<td>
									<form action="{{ route('role.destroy', $item->id) }}" method="post">
										@csrf
										@method('DELETE')
										<a href="#" class="btn btn-warning btn-sm" style="margin: 1px;">
											Edit
										</a>

										<button type="submit" class="btn btn-sm btn-danger" style="margin: 1px;">
											Hapus
										</button>
									</form>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="4">
									Belum Ada Data Level Akses
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection