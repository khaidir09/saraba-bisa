<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Tanda Terima Servis #{{ $items->nomor_servis }}</title>
	<style>
		body {
			color: #000000;
		}

		.nama-toko {
			font-size: 72px;
			font-weight: 800;
		}

		.capital {
			text-transform: uppercase;
		}

		table {
			font-size: 36px;
			line-height: 1em;
		}

		tbody, thead {
			color: #000000;
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
			<td scope="col"></td>
			</tr>
			<tr>
			<td scope="col">Nomor HP/WA {{ $users->nomor_hp_toko }}</td>
			<td scope="col"></td>
			</tr>
		</tbody>
	</table>

	<hr style="border-top: 1px dashed; margin-top: 0px; margin-bottom: 30px;">

	<h6 class="text-center">NOTA TERIMA SERVIS</h6>

	<section>
		<table class="table table-sm">
			<thead>
				<tr style="border-top-style: solid; border-right-style: solid;">
					<th colspan="2" style="border-left-style: solid;">Data Pelanggan</th>
					<th colspan="4" style="border-left-style: solid;">Data Barang</th>
				</tr>
			</thead>
			<tbody>
				<tr style="border-right-style: solid;">
					<td scope="row" style="border-left-style: solid;">Nama</th>
					<td class="capital">: {{ $items->customer->nama }}</td>
					<td scope="row" style="border-left-style: solid;">Jenis Barang</th>
					<td class="capital">: {{ $items->type->name }}</td>
					<td scope="row">IMEI/SN</th>
					<td class="capital">: {{ $items->imei }}</td>
				</tr>
				<tr style="border-right-style: solid;">
					<td scope="row" style="border-left-style: solid;">Nomor HP</th>
					<td>: {{ $items->customer->nomor_hp }}</td>
					<td scope="row" style="border-left-style: solid;">Merek</th>
					<td class="capital">: {{ $items->brand->name }}</td>
					<td scope="row">Kelengkapan</th>
					@if ($items->kelengkapan != null)
						<td class="capital">: {{ $items->kelengkapan }}</td>
					@else
						<td class="capital">: Hanya Unit</td>
					@endif
				</tr>
				<tr style="border-bottom-style: solid; border-right-style: solid;">
					<td scope="row" style="border-left-style: solid;">Alamat</th>
					<td class="capital">: {{ $items->customer->alamat }}</td>
					<td scope="row" style="border-left-style: solid;">Model Seri</th>
					<td class="capital">: {{ $items->modelserie->name }}</td>
					<td scope="row">Warna/Kapasitas</th>
					<td class="capital">: {{ $items->warna }} / {{ $items->capacity->name }}</td>
				</tr>
			</tbody>
		</table>
		<table class="table table-sm">
			<thead>
				<tr style="border-top-style: solid; border-right-style: solid;">
					<th colspan="2" style="border-left-style: solid;">Pengecekan</th>
					<th colspan="2" style="border-left-style: solid;">Pembayaran</th>
					<th colspan="2" class="text-center" style="border-left-style: solid;">Cek status servis via web</th>
				</tr>
			</thead>
			<tbody>
				<tr style="border-right-style: solid;">
					<td scope="row" style="border-left-style: solid;">Kerusakan</th>
					<td class="capital">: {{ $items->kerusakan }}</td>
					<td scope="row" style="border-left-style: solid;">Estimasi Biaya Servis</th>
					@if ($items->estimasi_biaya != null)
						<td>: Rp. {{ number_format($items->estimasi_biaya) }}</td>
					@else
						<td>: -</td>
					@endif
					<td colspan="2" style="border-left-style: solid;" class="text-center">{{ $users->link_toko }}/tracking</td>
				</tr>
				<tr style="border-right-style: solid;">
					<td scope="row" style="border-left-style: solid;">Pengecekan Fungsi</th>
					<td class="capital">: {{ $items->qc_masuk }}</td>
					<td scope="row" style="border-left-style: solid;">Uang Muka</th>
					@if ($items->uang_muka != null)
						<td>: Rp. {{ number_format($items->uang_muka) }}</td>
					@else
						<td class="capital">: Tidak ada</td>
					@endif
					<td colspan="2" style="border-left-style: solid;"></td>
				</tr>
				<tr style="border-bottom-style: solid; border-right-style: solid;">
					<td scope="row" style="border-left-style: solid;">Estimasi Pengerjaan</td>
					@if ($items->estimasi_pengerjaan != null)
						<td class="capital">: {{ $items->estimasi_pengerjaan }}</td>
					@else
						<td>: -</td>
					@endif
					<th scope="row" style="border-left-style: solid;"></th>
					<td>{{ $items->uang_muka }}</td>
					<td colspan="2" style="border-left-style: solid;"></td>
				</tr>
			</tbody>
			<tfoot class="table-borderless">
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<th colspan="2">Syarat & Ketentuan</th>
					<th>PIN</th>
					<th class="text-center">Pola</th>
					<th class="text-center">Pelanggan</th>
					<th class="text-center">Tertanda</th>
				</tr>
				<tr>
					<td colspan="2" style="width: 70px;">
						{!! $terms->description !!}
					</td>
					<td class="pt-3">
						<hr style="border-top: 3px dashed;">
					</td>
					<td class="text-center"><img src="{{ asset('images/pola.png') }}" alt=""></td>
					<td class="pt-5 text-center">{{ $items->customer->nama }}</td>
					<td class="pt-5 text-center">{{ Auth::user()->name }}</td>
				</tr>
			</tfoot>
		</table>
	</section>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>