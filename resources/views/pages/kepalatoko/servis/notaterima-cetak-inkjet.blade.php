<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tanda Terima Servis #{{ $items->nomor_servis }}</title>
	<style>
		body {
			color: #000000;
		}

		.text-center {
			text-align: center;
		}

		.text-right {
			text-align: right;
		}

		.text-left {
			text-align: left;
		}

		.capital {
			text-transform: uppercase;
		}

		.w-50 {
			width: 50%;
		}

		td,
		th,
		tr,
		table {
			border-collapse: collapse;
			font-size: 36px;
			line-height: 1em;
			width: 100%;
			padding: 12px;
			color: #000000;
		}

		#data {
			border-bottom: 1px solid #ddd;
		}
	</style>
</head>
<body>
	<div class="text-center">
		@if ($users->profile_photo_path != null)
			<img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" alt="" height="150" style="margin-top: 4px; margin-bottom: 8px;">
		@endif
	</div>
	<table>
		<tbody>
			<tr>
			<td scope="col" class="w-50"></td>
			<td scope="col" class="w-50"></td>
			</tr>
			<tr>
			<td scope="col" style="font-size: 40px; font-weight: 600;">{{ $users->nama_toko }} ({{ $users->deskripsi_toko }})</td>
			<td scope="col" class="text-right">No. Servis : {{ $items->nomor_servis }}</td>
			</tr>
			<tr>
			<td scope="col">{{ $users->alamat_toko }}</td>
			<td scope="col" class="text-right">Tanggal : {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}</td>
			</tr>
			<tr>
			<td scope="col">Nomor HP/WA {{ $users->nomor_hp_toko }}</td>
			<td scope="col" class="text-right">Dicetak oleh : {{ Auth::user()->name }}</td>
			</tr>
		</tbody>
	</table>

	<hr style="border-top: 1px dashed;">

		<h4 class="text-center">
			NOTA TERIMA SERVIS
		</h4>

	<table>
		<thead>
			<tr style="border-top-style: solid; border-right-style: solid;">
				<th id="data" colspan="2" style="border-left-style: solid;" class="text-left">Data Pelanggan</th>
				<th id="data" colspan="4" style="border-left-style: solid;" class="text-left">Data Barang</th>
			</tr>
		</thead>
		<tbody>
			<tr style="border-right-style: solid;">
				<td id="data" scope="row" style="border-left-style: solid;">Nama</th>
				<td id="data" class="capital">: {{ $items->customer->nama }}</td>
				<td id="data" scope="row" style="border-left-style: solid;">Jenis Barang</th>
				<td id="data" class="capital">: {{ $items->type->name }}</td>
				<td id="data" scope="row">IMEI/SN</th>
				<td id="data">: {{ $items->imei }}</td>
			</tr>
			<tr style="border-right-style: solid;">
				<td id="data" scope="row" style="border-left-style: solid;">Nomor HP</th>
				<td id="data">: {{ $items->customer->nomor_hp }}</td>
				<td id="data" scope="row" style="border-left-style: solid;">Merek</th>
				<td id="data" class="capital">: {{ $items->brand->name }}</td>
				<td id="data" scope="row">Kelengkapan</th>
				@if ($items->kelengkapan != null)
					<td id="data" class="capital">: {{ $items->kelengkapan }}</td>
				@else
					<td id="data" class="capital">: Hanya Unit</td>
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
	<table style="margin-top: 12px;">
		<thead>
			<tr style="border-top-style: solid; border-right-style: solid;">
				<th id="data" colspan="2" class="text-left" style="border-left-style: solid;">Pengecekan</th>
				<th id="data" colspan="2" class="text-left" style="border-left-style: solid;">Pembayaran</th>
				<th id="data" colspan="2" class="text-center" style="border-left-style: solid;">Cek status servis via web</th>
			</tr>
		</thead>
		<tbody>
			<tr style="border-right-style: solid;">
				<td id="data" scope="row" style="border-left-style: solid;">Kerusakan</th>
				<td id="data" class="capital">: {{ $items->kerusakan }}</td>
				<td id="data" scope="row" style="border-left-style: solid;">Estimasi Biaya Servis</th>
				@if ($items->estimasi_biaya != null)
					<td id="data">: Rp. {{ number_format($items->estimasi_biaya) }}</td>
				@else
					<td id="data">: -</td>
				@endif
				<td id="data" colspan="2" style="border-left-style: solid;" class="text-center">{{ $users->link_toko }}/tracking</td>
			</tr>
			<tr style="border-right-style: solid;">
				<td id="data" scope="row" style="border-left-style: solid;">Pengecekan Fungsi</th>
				<td id="data" class="capital">: {{ $items->qc_masuk }}</td>
				<td id="data" scope="row" style="border-left-style: solid;">Uang Muka</th>
				@if ($items->uang_muka != null)
					<td id="data">: Rp. {{ number_format($items->uang_muka) }}</td>
				@else
					<td id="data">: Tidak ada</td>
				@endif
				<td id="data" colspan="2" style="border-left-style: solid;"></td>
			</tr>
			<tr style="border-bottom-style: solid; border-right-style: solid;">
				<td scope="row" style="border-left-style: solid;">Estimasi Pengerjaan</td>
				@if ($items->estimasi_pengerjaan != null)
					<td class="capital">: {{ $items->estimasi_pengerjaan }}</td>
				@else
					<td>: -</td>
				@endif
				<th scope="row" style="border-left-style: solid;"></th>
				<td></td>
				<td colspan="2" style="border-left-style: solid;"></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td style="padding-bottom: 52px;"></td>
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
				<th class="text-center">Diterima</th>
			</tr>
			<tr>
				<td colspan="2" style="width: 70px;">
					{!! $terms->description !!}
				</td>
				<td>
					<hr style="border-top: 3px dashed;">
				</td>
				<td class="text-center" style="padding-top: 32px;"><img src="{{ asset('images/pola.png') }}" alt=""></td>
				<td class="text-center capital" style="padding-top: 52px;">{{ $items->customer->nama }}</td>
				<td class="text-center capital" style="padding-top: 52px;">{{ $items->penerima }}</td>
			</tr>
		</tfoot>
	</table>
</body>
</html>