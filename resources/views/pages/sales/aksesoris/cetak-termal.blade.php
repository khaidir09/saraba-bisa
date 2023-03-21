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
    <title>Nota Penjualan Aksesori #{{ $items->nomor_transaksi }}</title>
</head>
<body>
	<div class="resi">
		<p class="text-center mb-1">
			NOTA PENJUALAN <br>
			<strong>{{ $users->nama_toko }}</strong> <br>
			Telp/WA {{ $users->nomor_hp_toko }}
		</p>

		<hr style="border-top: 1px solid; margin: 0px;">

		<table>
			<tbody>
				<tr>
				<td class="title">No. Nota</td>
				<td class="value">: {{ $items->nomor_transaksi }}</td>
				</tr>
				<tr>
				<td class="title">Tanggal</td>
				<td class="value">: {{ \Carbon\Carbon::parse($items->created_at)->translatedFormat('d/m/Y') }}</td>
				</tr>
				<tr>
				<td class="title">Pelanggan</td>
				<td class="value">: {{ $items->customer->nama }}</td>
				</tr>
				<tr>
				<td class="title">No. HP</td>
				<td class="value">: {{ $items->customer->nomor_hp }}</td>
				</tr>
				<tr>
				<td class="title">Nama Barang</td>
				<td class="value">: {{ $items->accessory->name }}</td>
				</tr>
				@if ($items->quantity === '1')<tr>
					<td class="title">Harga</td>
					<td class="value">: Rp. {{ number_format($items->harga) }}</td>
					</tr>
				@else
					<tr>
					<td class="title">Jumlah</td>
					<td class="value">: {{ $items->quantity }} item</td>
					</tr>
					<tr>
					<td class="title">Harga</td>
					<td class="value">: Rp. {{ number_format($items->harga) }}</td>
					</tr>
					<tr>
					<td class="title">Total Harga</td>
					<td class="value">: Rp. {{ number_format($totalharga) }}</td>
					</tr>
				@endif
				@if ($items->diskon != null)
					<tr>
						<td class="title">Diskon</td>
						<td class="value">: Rp. {{ number_format($items->diskon) }}</td>
					</tr>
				@endif
				@if ($items->exp_garansi != null)
					@php
					$dt     = \Carbon\Carbon::now()->locale('id');
					$past   = $dt->subDay();
				@endphp
					<tr>
						<td class="title">Masa Garansi</td>
						<td class="value">
							: {{ \Carbon\Carbon::parse($items->exp_garansi)->diffForHumans($past, ['parts' => 1, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}
							(Exp. {{ \Carbon\Carbon::parse($items->exp_garansi)->translatedFormat('d/m/Y') }})
						</td>
					</tr>
				@endif
				<tr>
				<td class="title">Sales</td>
				<td class="value">: {{ $items->user->name }}</td>
				</tr>
			</tbody>
		</table>

		<hr style="border-top: 1px solid; margin: 0px;">

		<div class="text-center mt-1">
			<p class="mb-0">Dicetak {{ Auth::user()->name }}, <br> [{{ \Carbon\Carbon::now()->translatedFormat('d/m/Y H:i') }} WIB]</p>
			<p class="mb-0">Terima kasih atas kepercayaan Anda telah berbelanja di <br> {{ $users->nama_toko }}</p>
			<p>Barang yang sudah dibeli tidak bisa dikembalikan.</p>
		</div>
	</div>
</body>
</html>