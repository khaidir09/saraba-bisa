<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<style type="text/css">
		html {
			margin: 0;
			padding: 0;
		}
		body {
			font-size: 10px;
			color: #000000;
		}

		footer {
			margin-top: 5px;
		}

		.text-center {
			text-align: center;
		}

		.resi {
			margin-top: 5px;
			width: 155px;
    		max-width: 155px;
		}

		td,
		th,
		tr,
		table {
			border-collapse: collapse;
			line-height: 1em;
		}

		td.title {
			width: 60px;
			max-width: 60px;
			word-break: break-all;
		}

		td.value {
			width: 95px;
			max-width: 95px;
			word-break: break-all;
		}
	</style>
    <title>Tanda Terima Servis #{{ $items->nomor_servis }}</title>
</head>
<body>
	<div class="resi">
		<div class="text-center">
			@if ($users->profile_photo_path != null)
				<img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" alt="" height="50">
			@endif
			<p>
				TANDA TERIMA SERVIS <br>
				<strong>{{ $users->nama_toko }}</strong> <br>
				Telp/WA {{ $users->nomor_hp_toko }}
			</p>
		</div>

		<hr style="border-top: 1px solid; margin: 0px;">

		<table>
			<tbody>
				<tr>
				<td class="title">No. Servis</td>
				<td class="value">: {{ $items->nomor_servis }}</td>
				</tr>
				<tr>
				<td class="title">Tanggal</td>
				<td class="value">: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d/m/Y') }}</td>
				</tr>
				<tr>
				<td class="title">Kerusakan</td>
				<td class="value">: {{ $items->kerusakan }}</td>
				</tr>
				<tr>
				<td class="title">Pengecekan Fungsi</td>
				<td class="value">: {{ $items->qc_masuk }}</td>
				</tr>
				@if ($items->estimasi_biaya != null)
					<tr>
					<td class="title">Est. Biaya</td>
					<td class="value">: Rp. {{ number_format($items->estimasi_biaya) }}</td>
					</tr>
				@endif
				@if ($items->estimasi_pengerjaan != null)
					<tr>
					<td class="title">Est. Pengerjaan</td>
					<td class="value">: {{ $items->estimasi_pengerjaan }}</td>
					</tr>
				@endif
				<tr>
				<td class="title">Nama Barang</td>
				<td class="value">: {{ $items->type->name }} {{ $items->brand->name }} {{ $items->modelserie->name }}</td>
				</tr>
				<tr>
				<td class="title">IMEI/SN</td>
				<td class="value">: {{ $items->imei }}</td>
				</tr>
				<tr>
				<td class="title">Warna</td>
				<td class="value">: {{ $items->warna }}</td>
				</tr>
				<tr>
				<td class="title">Kapasitas</td>
				<td class="value">: {{ $items->capacity->name }}</td>
				</tr>
				<tr>
				<td class="title">Pelanggan</td>
				<td class="value">: {{ $items->customer->nama }}</td>
				</tr>
				<tr>
				<td class="title">Nomor HP</td>
				<td class="value">: {{ $items->customer->nomor_hp }}</td>
				</tr>
			</tbody>
		</table>

		<hr style="border-top: 1px solid; margin: 0px;">

		<footer class="text-center">
			<small>Dicetak [{{ \Carbon\Carbon::now()->translatedFormat('d/m/Y H:i') }}]</small>
			<p>Rek {{ $users->bank }} {{ $users->rekening }} <br> a.n. {{ $users->pemilik_rekening }}</p>
			<p>Cek status servis {{ $users->link_toko }}/tracking</p>
			<p>Silahkan bawa Nota Tanda Terima Servis ini pada saat pengambilan barang. Terima kasih.</p>
		</footer>
	</div>
</body>
</html>