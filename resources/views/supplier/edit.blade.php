@extends('layouts.app')

@section('content')
<div class="col-12 mb-2">
	<h4>Edit Data Supplier</h4>
</div>
<div class="col-md-12">
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
					Form Edit Data Supplier
				</div>
				<div class="col-md-6 text-right">
					<a href="{{ route('suppliers.index') }}" class="btn btn-danger btn-sm">
						Kembali
					</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<form action="{{ route('suppliers.update', $edit->id) }}" method="post">
				@csrf
				@method('PUT')
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Nama : </label>
							<input type="text" name="name" id="name" class="form-control flat {{ $errors->has('name') ? 'is-invalid':''}}" required placeholder="Masukan Nama Supplier" value="{{ $errors->has('name') ? old('name') : $edit->name }}">
							<p class="text-danger">
								{{ $errors->first('name') }}
							</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Nama Toko / Perusahaan : </label>
							<input type="text" name="company_name" id="company_name" class="form-control flat {{ $errors->has('company_name') ? 'is-invalid':''}}" required placeholder="Masukan Nama Toko / Perusahaan" value="{{ $errors->has('company_name') ? old('company_name') : $edit->company_name }}">
							<p class="text-danger">
								{{ $errors->first('company_name') }}
							</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">E-mail : </label>
							<input type="email" name="email" id="email" class="form-control flat {{ $errors->has('email') ? 'is-invalid':''}}" placeholder="Masukan E-Mail Supplier" value="{{ $errors->has('email') ? old('email') : $edit->email }}">
							<p class="text-danger">
								{{ $errors->first('email') }}
							</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Nomor Telfon : </label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text flat" id="rp-addon">(+62)</span>
								</div>
								<input type="number" name="phone_number" id="phone_number" class="form-control flat {{ $errors->has('phone_number') ? 'is-invalid':''}}" placeholder="Masukan Nomor Telfon Supplier" value="{{ $errors->has('phone_number') ? old('phone_number') : $edit->phone_number }}">
							</div>
							<p class="text-danger">
								{{ $errors->first('phone_number') }}
							</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Alamat Supplier : </label>
							<textarea name="address" id="address" cols="4" rows="4" class="form-control flat {{ $errors->has('address') ? 'is-invalid':''}}" required placeholder="Masukan Alamat Supplier">{{ $errors->has('address') ? old('address') : $edit->address }}</textarea>
							<p class="text-danger">
								{{ $errors->first('address') }}
							</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Deskripsi Supplier : </label>
							<textarea name="description" id="description" cols="4" rows="4" class="form-control flat {{ $errors->has('description') ? 'is-invalid':''}}" placeholder="Masukan Deskripsi Supplier">{{ $errors->has('description') ? old('description') : $edit->description }}</textarea>
							<p class="text-danger">
								{{ $errors->first('description') }}
							</p>
						</div>
					</div>
					<div class="col-md-12">
						<button type="submit" class="btn btn-success flat">
							Edit Data Supplier
						</button>
						<button type="reset" class="btn btn-danger flat">
							Reset Input
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection