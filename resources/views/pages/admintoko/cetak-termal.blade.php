<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		html {
			margin: 0;
			padding: 0;
		}
		body {
			font-size: 10px;
			color: #000000;
		}
		.resi {
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
		<p class="text-center mb-1">
			TANDA TERIMA SERVIS <br>
			<strong>{{ $users->nama_toko }}</strong> <br>
			Telp/WA +{{ $users->nomor_hp_toko }}
		</p>

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
				<tr>
				<td class="title">Est. Biaya</td>
				<td class="value">: Rp. {{ number_format($items->estimasi_biaya) }}</td>
				</tr>
				<tr>
				<td class="title">Est. Pengerjaan</td>
				<td class="value">: {{ $items->estimasi_pengerjaan }}</td>
				</tr>
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

		<div class="text-center mt-1">
			<p class="mb-0">Dicetak {{ Auth::user()->name }}, <br> [{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d/m/Y H:i') }} WIB]</p>
			<p>Silahkan bawa Nota Tanda Terima Servis ini pada saat pengambilan barang. Terima kasih.</p>
		</div>
	</div>
</body>
</html>