<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <title>Nota Pengambilan Servis #{{ $items->nomor_servis }}</title>
	<style>
		body {
			color: #000000;
		}

		.pt-5 {
			padding-top: 20px;
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
		.text-justify {
			text-align: justify;
		}

		.capital {
			text-transform: uppercase;
		}

		.w-100 {
			width: 100%;
		}

		.w-50 {
			width: 50%;
		}

		.w-25 {
			width: 25%;
		}

		td,
		th,
		tr,
		table {
			border-collapse: collapse;
			font-size: 36px;
			line-height: 1em;
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
	<table class="w-100">
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

	<h4 class="text-center">NOTA PENGAMBILAN SERVIS</h4>

	<table class="w-100">
		<thead>
			<tr style="border-top-style: solid; border-right-style: solid;">
				<th id="data" colspan="2" class="text-left" style="border-left-style: solid;">Data Pelanggan</th>
				<th id="data" colspan="4" class="text-left" style="border-left-style: solid;">Data Barang</th>
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
	<table class="w-100" style="margin-top: 12px;">
		<thead>
			<tr style="border-top-style: solid; border-right-style: solid;">
				<th id="data" colspan="2" class="text-left" style="border-left-style: solid;">Tindakan</th>
				<th id="data" colspan="2" class="text-left" style="border-left-style: solid;">Pengecekan (Tombol, Kamera, dll)</th>
				<th id="data" colspan="2" class="text-left" style="border-left-style: solid;">Pembayaran</th>
			</tr>
		</thead>
		<tbody>
			<tr style="border-right-style: solid;">
				<td id="data" scope="row" style="border-left-style: solid;">Kerusakan</th>
				<td id="data" class="capital">: {{ $items->kerusakan }}</td>
				<td id="data" scope="row" style="border-left-style: solid;">Fungsi (Masuk)</th>
				<td id="data" class="capital">: {{ $items->qc_masuk }}</td>
				<td id="data" scope="row" style="border-left-style: solid;">Metode Pembayaran</td>
				<td id="data" class="capital">: {{ $items->cara_pembayaran }}</td>
			</tr>
			<tr style="border-right-style: solid;">
				<td id="data" scope="row" style="border-left-style: solid;">Kondisi Servis</th>
				<td id="data" class="capital">: {{ $items->kondisi_servis }}</td>
				<td id="data" scope="row" style="border-left-style: solid;">Fungsi (Keluar)</th>
				<td id="data" class="capital">: {{ $items->qc_keluar }}</td>
				<td id="data" scope="row" style="border-left-style: solid;">Biaya Servis</td>
				<td id="data">: Rp. {{ number_format($items->biaya) }}</td>
			</tr>
			@if ($items->uang_muka != null && $items->diskon != null)
				<tr style="border-right-style: solid;">
					<td id="data" scope="row" style="border-left-style: solid;">Tindakan Servis</td>
					<td id="data" class="capital">: {{ $items->tindakan_servis }}</td>
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;">Uang Muka</td>
					<td id="data">: Rp. {{ number_format($items->uang_muka) }}</td>
				</tr>
				<tr style="border-right-style: solid;">
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;">Diskon</td>
					<td id="data">: Rp. {{ number_format($items->diskon) }}</td>
				</tr>
				<tr style="border-bottom-style: solid; border-right-style: solid;">
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;">Sisa Pembayaran</td>
					<td id="data">: Rp. {{ number_format($items->biaya - $items->uang_muka - $items->diskon) }}</td>
				</tr>
			@elseif ($items->uang_muka != null && $items->diskon === null)
				<tr style="border-right-style: solid;">
					<td id="data" scope="row" style="border-left-style: solid;">Tindakan Servis</td>
					<td id="data" class="capital">: {{ $items->tindakan_servis }}</td>
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;">Uang Muka</td>
					<td id="data">: Rp. {{ number_format($items->uang_muka) }}</td>
				</tr>
				<tr style="border-bottom-style: solid; border-right-style: solid;">
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;">Sisa Pembayaran</td>
					<td id="data">: Rp. {{ number_format($items->biaya - $items->uang_muka) }}</td>
				</tr>
			@elseif ($items->diskon != null && $items->uang_muka === null)
				<tr style="border-right-style: solid;">
					<td id="data" scope="row" style="border-left-style: solid;">Tindakan Servis</td>
					<td id="data" class="capital">: {{ $items->tindakan_servis }}</td>
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;">Diskon</td>
					<td id="data">: Rp. {{ number_format($items->diskon) }}</td>
				</tr>
				<tr style="border-bottom-style: solid; border-right-style: solid;">
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;">Sisa Pembayaran</td>
					<td id="data">: Rp. {{ number_format($items->biaya - $items->diskon) }}</td>
				</tr>
			@elseif ($items->diskon === null && $items->uang_muka === null)
				<tr style="border-right-style: solid; border-bottom-style: solid;">
					<td id="data" scope="row" style="border-left-style: solid;">Tindakan Servis</td>
					<td id="data" class="capital">: {{ $items->tindakan_servis }}</td>
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
					<td id="data" scope="row" style="border-left-style: solid;"></td>
					<td id="data"></td>
				</tr>
			@endif
		</tbody>
	</table>
	<table>
		<thead>
			<tr>
				@if ($items->exp_garansi === null)
					<td class="capital">
						Tidak ada garansi untuk tindakan servis ini.
					</td>
				@else
					<td class="capital">
						Garansi servis Anda aktif sampai tanggal <strong>{{ $items->exp_garansi }}</strong>
					</td>
				@endif
			</tr>
			<tr>
				<th class="w-50 text-left">Syarat & Ketentuan</th>
				<th colspan="2" class="text-center w-25">Pengambil</th>
				<th colspan="2" class="text-center w-25">Teknisi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-justify" style="font-style: italic;">
					{!! $terms->description !!} <br> <br>
					<span style="font-weight: bold;">Terima kasih atas kepercayaan Anda telah melakukan Servis di {{ $users->nama_toko }}</span>
				</td>
				<td colspan="2" class="pt-5 text-center capital">{{ $items->customer->nama }}</td>
				@if ($items->user != null)
					<td colspan="2" class="pt-5 text-center capital">{{ $items->user->name }}</td>
				@else
					<td colspan="2" class="pt-5 text-center capital">-</td>
				@endif
			</tr>
		</tbody>
	</table>
</body>
</html>