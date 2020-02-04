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
<div class="col-md-5 mb-2">
	<div class="card flat">
		<div class="card-header flat">
			Form Level Akses
		</div>
		<div class="card-body flat">
				@if (isset($edit))
					<form action="{{ route('role.update', $edit->id) }}" method="post">
					@method('PUT')
				@else
					<form action="{{ route('role.store') }}" method="post">
				@endif
				@csrf
				<div class="form-group">
					<label for="">Nama Level : </label>
					<input type="text" name="name" id="name" class="form-control flat {{ $errors->has('name') ? 'is-invalid':'' }}" autocomplete="off" autofocus required value="{{ isset($edit) ? $edit->name:old('name') }}">
					<p class="text-danger text-sm">
						{{ $errors->first('name') }}
					</p>
				</div>
				<div class="form-group">
					@if (isset($edit))
						<button type="submit" class="btn btn-success btn-sm flat" onclick="return confirm('Lakukan Perubahan Data ?')">
							Simpan Data
						</button>
						<button type="reset" class="btn btn-warning btn-sm flat">
							Reset Input
						</button>
						<a href="{{ route('role.index') }}" class="btn btn-danger btn-sm flat" onclick="return confirm('Peringatan ! \nPerubahan Mungkin Belum Tersimpan ! \nYakin Untuk Membatalkan Perubahan ?')">
							Batal
						</a>
					@else
						<button type="submit" class="btn btn-success btn-sm flat">
							Tambah Data
						</button>
						<button type="reset" class="btn btn-danger btn-sm flat">
							Reset Input
						</button>
					@endif
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
										<a href="{{ route('role.edit', $item->id) }}" class="btn btn-warning btn-sm" style="margin: 1px;">
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
			{{ $roles->links() }}
		</div>
	</div>
</div>
@endsection

@section('script')
	<script>
		$(document).ready(function() {
			//
		});
	</script>
@endsection