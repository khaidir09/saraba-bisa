<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <title>Nota Pengambilan Servis #{{ $items->nomor_servis }}</title>
	<style>
		@page {
            size: A4; /* Ukuran halaman A4, bisa disesuaikan */
            margin: 3mm; /* Atur margin atas, kanan, bawah, dan kiri */
        }
		body {
			margin: 0;
		}

		.pt-5 {
			padding-top: 40px;
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

		.w-75 {
			width: 75%;
		}

		.w-25 {
			width: 25%;
		}

		td,
		th,
		tr,
		table {
			border-collapse: collapse;
			font-size: 12px;
			line-height: 1em;
			padding: 4px;
			color: #000000;
		}

		#data {
			border-bottom: 1px solid #ddd;
		}
	</style>
</head>
<body>
	<table class="w-100">
		<tr>
			@if ($users->profile_photo_path != null)
				<td class="text-center" style="width: 30%">
					<img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" alt="" height="70">
				</td>
				<td style="height: 50px; vertical-align: middle; text-align: left; line-height: 1.5em;"><strong>{{ $users->nama_toko }} ({{ $users->deskripsi_toko }})</strong> <br>
					{{ $users->alamat_toko }} - {{ $users->nomor_hp_toko }}
				</td>
			@else
				<td style="text-align: left; line-height: 1.5em;"><strong>{{ $users->nama_toko }} ({{ $users->deskripsi_toko }})</strong> <br>
					{{ $users->alamat_toko }} - {{ $users->nomor_hp_toko }}
				</td>
			@endif
		</tr>
	</table>

	<hr style="border-top: 1px dashed;">

	<h4 class="text-center" style="margin-bottom: 6px; margin-top: 6px;">NOTA PENGAMBILAN SERVIS</h4>

	<table class="w-100">
		<tr>
			<td class="text-left"><strong>No. Servis</strong> : {{ $items->nomor_servis }}</td>
			<td class="text-right"><strong>Tanggal</strong> : {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}</td>
			<td class="text-right"><strong>Dicetak oleh</strong> : {{ Auth::user()->name }}</td>
		</tr>
	</table>

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
	<table class="w-100" style="padding-top: 0px;">
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
	<table class="w-100">
		<tbody>
			<tr>
				@if ($items->catatan != null)
					<td colspan="4">
						<strong>Catatan</strong> : {{ $items->catatan }}
					</td>
				@endif
			</tr>
			<tr>
				<th class="text-left w-75">Syarat & Ketentuan</th>
				@if ($items->exp_garansi === null)
					<th colspan="3" class="w-25 text-right">
						(Tidak ada garansi)
					</th>
				@else
					<th colspan="3" class="w-25 text-right">
						(Garansi <strong>{{ $items->exp_garansi }}</strong>)
					</th>
				@endif
			</tr>
			<tr>
				<td class="text-justify" style="font-style: italic; padding-bottom: 4px; padding-right: 30px;">
					{!! $terms->description !!}
				</td>
				<th class="text-center">Pengambil</th>
				<th class="text-center">Penyerah</th>
				<th class="text-center">Teknisi</th>
			</tr>
			<tr>
				<td></td>
				<td class="text-center capital">{{ $items->pengambil }}</td>
				<td class="text-center capital">{{ $items->penyerah }}</td>
				@if ($items->user != null)
					<td class="text-center capital">{{ $items->user->name }}</td>
				@else
					<td class="text-center capital">-</td>
				@endif
			</tr>
		</tbody>
	</table>
</body>
</html>