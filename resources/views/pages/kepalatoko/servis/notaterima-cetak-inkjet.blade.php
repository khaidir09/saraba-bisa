<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Tanda Terima Servis #{{ $items->nomor_servis }}</title>
	<style>
		.nama-toko {
			font-size: 72px;
			font-weight: 800;
		}

		table {
			font-size: 30px;
			line-height: 1em;
		}
	</style>
</head>
<body>
	<table class="table table-sm table-borderless">
		<tbody>
			<tr>
			<td scope="col" class="w-75 nama-toko">{{ $users->nama_toko }}</td>
			<td scope="col" class="w-25">No. Servis : {{ $items->nomor_servis }}</td>
			</tr>
			<tr>
			<td scope="col deskripsi-toko" style="font-size: 40px; font-weight: 600;">{{ $users->deskripsi_toko }}</td>
			<td scope="col">Tanggal : {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}</td>
			</tr>
			<tr>
			<td scope="col alamat-toko">{{ $users->alamat_toko }}</td>
			<td scope="col">Dicetak oleh : {{ Auth::user()->name }}</td>
			</tr>
			<tr>
			<td scope="col">Nomor HP/WA {{ $users->nomor_hp_toko }}</td>
			<td scope="col"></td>
			</tr>
		</tbody>
	</table>

	<hr style="border-top: 1px solid; margin-top: 0px; margin-bottom: 30px;">

	<h6 class="text-center">NOTA TERIMA SERVIS</h6>

	<section>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th colspan="2">Data Pelanggan</th>
					<th colspan="4">Data Barang</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">Nama</th>
					<td>: {{ $items->customer->nama }}</td>
					<th scope="row">Jenis Barang</th>
					<td>: {{ $items->type->name }}</td>
					<th scope="row">IMEI/SN</th>
					<td>: {{ $items->imei }}</td>
				</tr>
				<tr>
					<th scope="row">Nomor HP</th>
					<td>: {{ $items->customer->nomor_hp }}</td>
					<th scope="row">Merek</th>
					<td>: {{ $items->brand->name }}</td>
					<th scope="row">Kelengkapan</th>
					@if ($items->kelengkapan != null)
						<td>: {{ $items->kelengkapan }}</td>
					@else
						<td>: Hanya Unit</td>
					@endif
				</tr>
				<tr>
					<th scope="row">Alamat</th>
					<td>: {{ $items->customer->alamat }}</td>
					<th scope="row">Model Seri</th>
					<td>: {{ $items->modelserie->name }}</td>
					<th scope="row">Warna/Kapasitas</th>
					<td>: {{ $items->warna }} / {{ $items->capacity->name }}</td>
				</tr>
			</tbody>
		</table>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th colspan="2">Pengecekan</th>
					<th colspan="2">Pembayaran</th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">Kerusakan</th>
					<td>: {{ $items->kerusakan }}</td>
					<th scope="row">Estimasi Biaya Servis</th>
					@if ($items->estimasi_biaya != null)
						<td>: Rp. {{ number_format($items->estimasi_biaya) }}</td>
					@else
						<td>: -</td>
					@endif
					<th scope="row"></th>
					<td></td>
				</tr>
				<tr>
					<th scope="row">Pengecekan Fungsi</th>
					<td>: {{ $items->qc_masuk }}</td>
					<th scope="row">Uang Muka</th>
					@if ($items->uang_muka != null)
						<td>: Rp. {{ number_format($items->uang_muka) }}</td>
					@else
						<td>: Tidak ada</td>
					@endif
					<th scope="row"></th>
					<td></td>
				</tr>
				<tr>
					<th scope="row">Estimasi Pengerjaan</th>
					@if ($items->estimasi_pengerjaan != null)
						<td>: {{ $items->estimasi_pengerjaan }}</td>
					@else
						<td>: -</td>
					@endif
					<th scope="row"></th>
					<td>{{ $items->uang_muka }}</td>
					<th scope="row"></th>
					<td></td>
				</tr>
			</tbody>
		</table>

		<hr style="border-top: 1px dashed; margin: 0px;">
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>