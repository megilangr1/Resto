@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<h4>Master Data Kategori</h4>
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
			Form Data Kategori
		</div>
		<div class="card-body">
			@if (isset($edit))
			<form action="{{ route('category.update', $edit->id) }}" method="post">
				@method('PUT')
			@else
			<form action="{{ route('category.store') }}" method="post">
			@endif
				@csrf
				<div class="form-group">
					<label for="">Nama Kategori : </label>
					<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }} flat" value="{{ isset($edit) ? $edit->name : old('name') }}" required autocomplete="off" autofocus placeholder="Contoh: Main Course">
					<p class="text-danger">
						{{ $errors->first('name') }}
					</p>
				</div>
				<div class="form-group">
					<label for="">Deskripsi Kategori : </label>
					<textarea name="description" id="description" cols="10" rows="4" class="form-control {{ $errors->has('description') ? 'is-invalid':'' }} flat" placeholder="*Boleh di-Kosongkan">{{ isset($edit) ? $edit->description : old('description') }}</textarea>
					<p class="text-danger">
						{{ $errors->first('description') }}
					</p>
				</div>
				<div class="form-group">
					@if (isset($edit))
						<button type="submit" class="btn btn-success flat">
							Simpan
						</button>
						<button type="reset" class="btn btn-warning flat">
							Reset
						</button>
						<a href="{{ route('category.index') }}" class="btn btn-danger flat">
							Batal
						</a>
					@else
						<button type="submit" class="btn btn-success btn-sm flat">
							Tambah Data Kategori
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
		<div class="card-header">
			Data Kategori
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover mb-0">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Kategori</th>
							<th>Deskripsi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($categories as $item)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->description }}</td>
							<td>
								<form action="{{ route('category.destroy', $item->id) }}" method="post">
									@csrf
									@method('DELETE')

									<a href="{{ route('category.edit', $item->id) }}" class="btn btn-warning btn-sm" style="margin: 1px;">
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
								Belum Ada Data Kategori
							</td>
						</tr>
						@endforelse
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4" class="pb-0">
								<div class="float-right">
									{{ $categories->links() }}
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection