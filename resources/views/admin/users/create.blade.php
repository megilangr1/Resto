@extends('layouts.app')

@section('content')
<div class="col-md-12 mb-2">
	<h4>Manajemen Pengguna</h4>
</div>
<div class="col-md-12">
	<div class="card flat">
		<div class="card-header">
			<div class="row">
				<div class="col-md-6">
					Form Tambah Pengguna
				</div>
				<div class="col-md-6 text-right">
					<a href="{{ route('user.index') }}" class="btn btn-sm btn-danger">	
						Kembali
					</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<form action="{{ route('user.store') }}" method="post">
				@csrf
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="name">Nama Pengguna : </label>
							<input type="text" name="name" id="name" class="form-control flat {{ $errors->has('name') ? 'is-invalid':'' }}" autocomplete="off" autofocus required placeholder="Masukan Nama Pengguna.." value="{{ old('name') }}">
							<p class="text-danger">
								{{ $errors->first('name') }}
							</p>
						</div>
						<div class="form-group">
							<label for="username">Username : </label>
							<input type="text" name="username" id="username" class="form-control flat {{ $errors->has('username') ? 'is-invalid':'' }}" autocomplete="off" required placeholder="Masukan Username Pengguna.." value="{{ old('username') }}">
							<p class="text-danger">
								{{ $errors->first('username') }}
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="name">E-Mail : </label>
							<input type="email" name="email" id="email" class="form-control flat {{ $errors->has('email') ? 'is-invalid':'' }}" autocomplete="off" required placeholder="Masukan E-mail Pengguna.." value="{{ old('email') }}">
							<p class="text-danger">
								{{ $errors->first('email') }}
							</p>
						</div>
						<div class="form-group">
							<label for="">Password : </label>
							<input type="password" name="password" id="password" class="form-control flat {{ $errors->has('password') ? 'is-invalid':'' }}" autocomplete="off" required placeholder="Masukan Password Pengguna..">
							<p class="text-danger">
								{{ $errors->first('password') }}
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Level Akses Pengguna :</label>
							<select name="roles" id="roles" class="form-control flat">
								<option value="">Pilih Level Pengguna</option>
								@forelse ($roles as $item)
									<option value="{{ $item->name }}" {{ old('roles') == $item->name ? 'selected':'' }}>{{ $item->name }}</option>
								@empty
									<option value="">Belum Ada Data Role</option>
								@endforelse
							</select>
							<p class="text-danger">
								{{ $errors->first('roles') }}
							</p>
						</div>
					</div>
					<div class="col-md-12 mt-2">
						<button type="submit" class="btn btn-success flat">
							Tambah Data Pengguna
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