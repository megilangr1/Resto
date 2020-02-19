@extends('layouts.app')

@section('content')
<div class="col-12 mb-2">
	<h4>Tambah Data Supplier</h4>
</div>
<div class="col-12">
	<div class="card flat">
		<div class="card-header">
			<div class="row">
				<div class="col-md-6">
					Form Tambah Data Supplier
				</div>
				<div class="col-md-6 text-right">
					<a href="{{ route('suppliers.index') }}" class="btn btn-danger btn-sm">
						Kembali
					</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<form action="{{ route('suppliers.store') }}" method="post">
				@csrf
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Nama : </label>
							<input type="text" name="name" id="name" class="form-control flat" required placeholder="Masukan Nama Supplier">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Nama Toko / Perusahaan : </label>
							<input type="text" name="company_name" id="company_name" class="form-control flat" required placeholder="Masukan Nama Toko / Perusahaan">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">E-mail : </label>
							<input type="email" name="email" id="email" class="form-control flat" placeholder="Masukan E-Mail Supplier">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Nomor Telfon : </label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text flat" id="rp-addon">(+62)</span>
								</div>
								<input type="text" name="phone_number" id="phone_number" class="form-control flat" placeholder="Masukan Nomor Telfon Supplier">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Alamat Supplier : </label>
							<textarea name="address" id="address" cols="4" rows="4" class="form-control flat" placeholder="Masukan Alamat Supplier"></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Deskripsi Supplier : </label>
							<textarea name="description" id="description" cols="4" rows="4" class="form-control flat" placeholder="Masukan Deskripsi Supplier"></textarea>
						</div>
					</div>
					<div class="col-md-12">
						<button type="submit" class="btn btn-success flat">
							Tambah Data Supplier
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