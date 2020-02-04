@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<h4>Master Data Satuan</h4>
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
		<div class="card-header">
			Form Data Satuan
		</div>
		<div class="card-body">
			@if (isset($edit))
			<form action="{{ route('units.update', $edit->id) }}" method="post">
				@method('PUT')
			@else
			<form action="{{ route('units.store') }}" method="post">
			@endif
				@csrf
				<div class="form-group">
					<label for="">Nama Satuan : </label>
					<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }} flat" value="{{ isset($edit) ? $edit->name : old('name') }}" required autocomplete="off" autofocus placeholder="Contoh: Gram">
					<p class="text-danger">
						{{ $errors->first('name') }}
					</p>
				</div>
				<div class="form-group">
					<label for="">Nama Pendek Satuan : </label>
					<input type="text" name="short_name" id="short_name" class="form-control {{ $errors->has('short_name') ? 'is-invalid':'' }} flat" value="{{ isset($edit) ? $edit->short_name : old('short_name') }}" required  autocomplete="off" placeholder="Contoh: gr">
				</div>
				<div class="form-group">
					@if (isset($edit))
						<button type="submit" class="btn btn-success flat">
							Simpan
						</button>
						<button type="reset" class="btn btn-warning flat">
							Reset
						</button>
						<a href="{{ route('units.index') }}" class="btn btn-danger flat">
							Batal
						</a>
					@else
						<button type="submit" class="btn btn-success flat">
							Tambah Data Satuan
						</button>
						<button type="reset" class="btn btn-danger flat">
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
		<div class="card-header">
			Data Satuan
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Satuan</th>
							<th class="text-center">-</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($units as $item)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $item->name }}</td>
							<td class="text-center">({{ $item->short_name }})</td>
							<td>
								<form action="{{ route('units.destroy', $item->id) }}" method="post">
									@csrf
									@method('DELETE')

									<a href="{{ route('units.edit', $item->id) }}" class="btn btn-warning btn-sm" style="margin: 1px;">
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
							<td colspan="4" class="text-center">
								Belum Ada Data Satuan
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