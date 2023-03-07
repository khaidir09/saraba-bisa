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
		}
		.resi {
			width: 155px;
    		max-width: 155px;
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
    <title>Nota Pengambilan Servis Selesai #{{ $items->nomor_servis }}</title>
</head>
<body>
	<div class="resi">
		<p class="text-center">
			NOTA PENGAMBILAN SERVIS <br>
			<strong>{{ $users->nama_toko }}</strong> <br>
			Telp/WA +{{ $users->nomor_hp_toko }}
		</p>

		<hr>

		<table class="table table-sm table-borderless">
			<tbody>
				<tr>
				<td class="title">No. Servis</td>
				<td class="value">: {{ $items->nomor_servis }}</td>
				</tr>
				<tr>
				<td class="title">Pelanggan</td>
				<td class="value">: {{ $items->customer->nama }}</td>
				</tr>
				<tr>
				<td class="title">Nomor HP</td>
				<td class="value">: {{ $items->customer->nomor_hp }}</td>
				</tr>
				<tr>
				<td class="title">Tgl. Masuk</td>
				<td class="value">: {{ \Carbon\Carbon::parse($items->created_at)->locale('id')->translatedFormat('d/m/Y') }} [{{ $items->penerima }}]</td>
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
				<td class="title">Kelengkapan</td>
				<td class="value">:
					@if ($items->kelengkapan != null)
						{{ $items->kelengkapan }}
						@else
						Hanya Barang
					@endif
				</td>
				</tr>
				<tr>
				<td class="title">Kerusakan</td>
				<td class="value">: {{ $items->kerusakan }}</td>
				</tr>
				<tr>
				<td class="title">Tindakan</td>
				<td class="value">: {{ $items->tindakan_servis }}</td>
				</tr>
				<tr>
				<td class="title">Biaya Servis</td>
				<td class="value">: Rp. {{ number_format($items->biaya) }}</td>
				</tr>
				<tr>
				<td class="title">Pembayaran</td>
				<td class="value">: {{ $items->cara_pembayaran }}</td>
				</tr>
				<tr>
				<td class="title">Garansi</td>
				<td class="value">: {{ $items->garansi }}</td>
				</tr>
				<tr>
				<td class="title">Teknisi</td>
				<td class="value">: {{ $items->user->name }}</td>
				</tr>
				<tr>
				<td class="title">Pengecekan Masuk</td>
				<td class="value">: {{ $items->qc_masuk }}</td>
				</tr>
				<tr>
				<td class="title">Pengecekan Keluar</td>
				<td class="value">: {{ $items->qc_keluar }}</td>
				</tr>
				<tr>
				<td class="title">Tgl. Ambil</td>
				<td class="value">: {{ \Carbon\Carbon::parse($items->tgl_ambil)->locale('id')->translatedFormat('d/m/Y') }}</td>
				</tr>
				<tr>
				<td class="title">Pengambil</td>
				<td class="value">: {{ $items->pengambil }}</td>
				</tr>
			</tbody>
		</table>

		<hr>

		<div class="text-center">
			<p>Dicetak {{ Auth::user()->name }}, <br> [{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d/m/Y H:i') }} WIB]</p>
			<p>Terima kasih atas kepercayaan Anda telah melakukan Servis di {{ $users->nama_toko }}</p>
		</div>
	</div>
</body>
</html>