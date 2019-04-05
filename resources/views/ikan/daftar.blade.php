@extends('layouts.app')

@section('title', 'Daftar Ikan')

@section('style')
<style type="text/css">
	body{
		background-color: #e7edee !important;
	}
</style>
@endsection

@section('content')


<div class="head-pengola-produk">
	<div class="heder-pengola">
		<h1>Managemen Ikan</h1>
	</div>
</div>

<div class="grup-all-daftar-managemen">
	<div class="detail-transaksi">
		<div class="col-xs-12 col-sm-4 jarak-margin" style="padding: 0;text-align:center;">
			<div class="pekerja-list">
				<div class="col-xs-4" style="text-align: center;">
					<i class="fa fa-briefcase" aria-hidden="true"></i>
				</div>
				<div class="col-xs-8 detail-style" style="text-align: right;">
					<p>10</p>
					<h3>Pekerja</h3>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 jarak-margin" style="padding: 0;text-align:center;">
			<div class="produk-jual">
				<div class="col-xs-4" style="text-align: center;">
					<i class="fa fa-product-hunt" aria-hidden="true"></i>
				</div>
				<div class="col-xs-8 detail-style" style="text-align: right;">
					<p>{{count($produks)}}</p>
					<h3>Produk</h3>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 jarak-margin" style="padding: 0;text-align:center;">
			<div class="keranjang-belanja">
				<div class="col-xs-4" style="text-align: center;">
					<i class="fa fa-shopping-basket" aria-hidden="true"></i>
				</div>
				<div class="col-xs-8 detail-style" style="text-align: right;">
					<p>12</p>
					<h3>Transaksi</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="daftar-ikan-crud">
		<div class="button-create">
			<a href="#!"  data-toggle="modal" data-target="#myModal">Tambah Produk</a>
		</div>
		<div class="well-content table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Stok</th>
						<th>Satuan</th>
						<th>Harga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($produks as $produk)
					<tr>
						<th>{{$no++}}</th>
						<td>{{$produk->name}}</td>
						<td>{{$produk->stok}}</td>
						<td>{{$produk->satuan}}</td>
						<td>{{$produk->harga}}</td>
						<td class="button-aksi-table">
							<a href="#!" data-toggle="modal" data-target="#editikan{{$produk->id}}">Edit</a>
							<a href="/produk/{{$produk->id}}/destroy">Delete</a>
							<a href="#!">Detail</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Tambah Produk Ikan</h4>
			</div>
			<div class="modal-body">
				<form action="/produk" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-xs-12 col-sm-5" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Nama Ikan</label>
							<input type="judul" name="name" class="form-control" value="{{ old('name') }}" id="mod-inputan" placeholder="Nama">
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Stok</label>
							<input type="judul" name="stok" class="form-control" value="{{ old('stok') }}" id="mod-inputan" placeholder="Stok">
						</div>
						<div class="col-xs-12 col-sm-3" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Harga</label>
							<input type="judul" name="harga" class="form-control" value="{{ old('harga') }}" id="mod-inputan" placeholder="Harga">
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Satuan</label>
							<select id="select-satuan" name="satuan">
								<option>Kg</option>
								<option>Ekor</option>
								<option>Ons</option>
								<option>Satuan</option>
								<option>Cm</option>
								<option>inchi</option>
								<option>liter</option>
							</select>
						</div>
					</div>
					<div class="moda-padding">
						<div class="form-group">
							<label class="lable-mod" for="exampleInputEmail1">Foto Ikan</label>
							<input type="file" name="image" class="form-control" value="{{ old('image') }}" id="mod-inputan" placeholder="Foto">
						</div>
						<div class="form-group">
							<label class="lable-mod" for="textarea-tinymce">Deskripsi</label> 
							<textarea name="deskripsi" rows="8" id="textarea-tinymce" placeholder="Deskripsi Ikan...">{{ old('deskripsi') }}</textarea>
						</div>
						<button type="submit" class="btn btn-block btn-default">Submit</button>
					</div>
					{{ csrf_field() }}
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>

@section('script')
@foreach ($produks as $produk)
<script type="text/javascript">
	tinymce.init({
		selector: '#editcomment-tinymce{{$produk->id}}',
		menubar: false,
		plugins: 'image, link, emoticons',
		branding: false,
	});
</script>
@endforeach
@endsection
<!-- edit ikan -->
@foreach ($produks as $produk)
<div class="modal fade" id="editikan{{$produk->id}}" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Edit Produk Ikan</h4>
			</div>
			<div class="modal-body">
				<form action="/produk/{{ $produk->id }}" method="POST"  enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-xs-12 col-sm-5" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Nama Ikan</label>
							<input type="judul" name="name" class="form-control" value="{{ old('name') ? old('name') : $produk->name  }}" id="mod-inputan" placeholder="Nama">
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Stok</label>
							<input type="judul" name="stok" class="form-control" value="{{ old('stok') ? old('stok') : $produk->stok  }}" id="mod-inputan" placeholder="Stok">
						</div>
						<div class="col-xs-12 col-sm-3" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Harga</label>
							<input type="judul" name="harga" class="form-control" value="{{ old('harga') ? old('harga') : $produk->harga  }}" id="mod-inputan" placeholder="Harga">
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Satuan</label>
							<select id="select-satuan" name="satuan">
								<option {{strcasecmp($produk->satuan, 'kg') == 0  ? 'selected' : ''}}>Kg</option>
								<option {{strcasecmp($produk->satuan, 'Ekor') == 0  ? 'selected' : ''}}>Ekor</option>
								<option {{strcasecmp($produk->satuan, 'Ons') == 0  ? 'selected' : ''}}>Ons</option>
								<option {{strcasecmp($produk->satuan, 'Satuan') == 0  ? 'selected' : ''}}>Satuan</option>
								<option {{strcasecmp($produk->satuan, 'Cm') == 0  ? 'selected' : ''}}>Cm</option>
								<option {{strcasecmp($produk->satuan, 'inchi') == 0  ? 'selected' : ''}}>inchi</option>
								<option {{strcasecmp($produk->satuan, 'liter') == 0  ? 'selected' : ''}}>liter</option>
							</select>
						</div>
					</div>
					<div class="moda-padding">
						<div class="form-group">
							<label class="lable-mod" for="exampleInputEmail1">Foto Ikan</label>
							<input type="file" name="image" class="form-control" value="{{ old('image') ? old('image') : $produk->image  }}" id="mod-inputan" placeholder="Foto">
						</div>
						<div class="form-group">
							<label class="lable-mod" for="textarea-tinymce">Deskripsi</label> 
							<textarea name="deskripsi" rows="8" id="editcomment-tinymce{{ $produk->id }}" placeholder="Deskripsi Ikan...">{{ old('deskripsi') ? old('deskripsi') : $produk->deskripsi  }}</textarea>
						</div>
						<button type="submit" class="btn btn-block btn-default">Submit</button>
					</div>
					{{ csrf_field() }}
					<input type="hidden" name="_method"  value="PUT">
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
@endforeach

@endsection