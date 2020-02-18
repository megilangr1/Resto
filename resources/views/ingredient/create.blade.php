@extends('layouts.app')

@section('content')
<div class="col-12 mb-2">
	<h4>Tambah Bahan Pokok</h4>
</div>
<div class="col-12">
	<div class="card flat">
		<div class="card-header">
			<div class="row">
				<div class="col-md-6">
					Form Bahan Pokok
				</div>
				<div class="col-md-6 text-right">
					<a href="{{ route('ingredients.index') }}" class="btn btn-sm btn-danger">
						Kembali
					</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<form action="{{ route('ingredients.store') }}" method="post">
				@csrf
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Nama Bahan Pokok :</label>
							<input type="text" name="name" id="name" class="form-control flat {{ $errors->has('name') ? 'is-invalid':'' }}" required autofocus placeholder="Masukan Nama Bahan Pokok" value="{{ old('name') }}">
						</div>
						<p class="text-danger">
							{{ $errors->first('name') }}
						</p>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Satuan Bahan Pokok : </label>
							<select name="unit_id" id="unit_id" class="form-control select2 flat" data-placeholder="Pilih Satuan Bahan Pokok" style="width: 100%;">
								<option value=""></option>
								@foreach ($units as $item)
										<option value="{{ $item->id }}" {{ old('unit_id') == $item->id ? 'selected':'' }}>{{ $item->name }} ({{ $item->short_name }})</option>
								@endforeach
							</select>
							<p class="text-danger">
								{{ $errors->first('unit_id') }}
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Harga Bahan Pokok : </label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="rp-addon" style="border-radius: 0px;">Rp.</span>
								</div>
								<input type="number" name="price" id="price" class="form-control flat {{ $errors->has('price') ? 'is-invalid':'' }}" min="0" required placeholder="Masukan Harga Bahan Pokok" value="{{ old('price') }}">
							</div>
							<p class="text-danger">
								{{ $errors->first('price') }}
							</p>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Deskripsi Bahan Pokok : </label>
							<textarea name="description" id="description" cols="4" rows="4" class="form-control flat {{ $errors->has('description') ? 'is-invalid':'' }}" placeholder="Masukan Deskripsi Bahan Pokok">{{ old('description') }}</textarea>
							<p class="text-danger">
								{{ $errors->first('description') }}
							</p>
						</div>
					</div>
					<div class="col-md-12">
						<button type="submit" class="btn flat btn-success">
							Tambah Data Bahan Pokok
						</button>
						<button type="reset" class="btn flat btn-danger">
							Reset Input
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	$(document).ready(function() {
		$('.select2').select2();
		$('#name').focus();
	});
</script>
@endsection