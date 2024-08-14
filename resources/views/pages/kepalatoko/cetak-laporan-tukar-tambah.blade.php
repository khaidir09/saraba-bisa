<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Tukar Tambah</title>
	<style>
		@page {
            margin: 3mm 4mm 10mm 3mm; /* Atur margin atas, kanan, bawah, dan kiri */
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

		#ringkasan td,
		th,
		tr,
		table {
			border-collapse: collapse;
			font-size: 12px;
			line-height: 1em;
			padding: 4px 0 4px 0;
			text-align: left;
		}

		#detail td,
		#detail th,
		#detail tr,
		#detail table {
			border-collapse: collapse;
			font-size: 12px;
			line-height: 1em;
			padding: 4px;
			text-align: center;
			border: solid;
		}

		#analisis td,
		th,
		tr,
		table {
			border-collapse: collapse;
			font-size: 14px;
			line-height: 1em;
			width: 100%;
			padding: 4px 0 4px 0;
			text-align: left;
		}

		#data {
			border-bottom: 1px solid #ddd;
		}
	</style>
</head>
<body>
	<div class="text-center">
		@if ($users->profile_photo_path != null)
			<img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" alt="" height="70">
		@endif
		<h4 style="margin-top: 5px; margin-bottom: 0">{{ $users->nama_toko }}</h4>
		<p style="margin-top: 3px; margin-bottom: 5px;">{{ $users->alamat_toko }}</p>
	</div>

	<hr style="border-top: 1px dashed; margin-bottom: 0;">

	<div class="text-center">
		<h4 style="margin-bottom: 6px; margin-top: 5px;">
			Laporan Tukar Tambah
		</h4>
		<p style="margin-top: 0">Periode : {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</p>
	</div>
	
	<h4 style="margin-bottom: 6px; text-decoration: underline;">
		Ringkasan
	</h4>

	<table id="ringkasan">
		<tbody>
			<tr>
				<th>Total Item</th>
				<th>: {{ $total_item }} item</th>
				<th class="text-right">Total Pembelian</th>
				<th class="text-right">: Rp. {{ number_format($total_pembelian) }}</th>
			</tr>
		</tbody>
	</table>

	<h4 style="margin-top: 8px; margin-bottom: 6px; text-decoration: underline;">
		Detail Penjualan
	</h4>

	<table id="detail">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nota</th>
				<th>Pelanggan</th>
				<th>Produk Dijual</th>
				<th>Harga Jual</th>
				<th>Produk Ditukar</th>
				<th>Harga Tukar</th>
				<th>Sisa Pembayaran</th>
			</tr>
		</thead>
		<tbody>
			@php
				$i = 1
			@endphp
			@foreach ($tradeInReports as $key => $item)
				<tr>
					<td style="width: 10px;">{{ $i++ }}</td>
					<td class="text-center" style="width: 60px;">
						{{ $item->invoice }}
					</td>
					<td style="text-align: left; width: 90px;" class="capital">
						{{ $item->pelanggan }}
					</td>
					<td style="width: 70px; text-align: left;">{{ $item->produk_dijual }} ({{ $item->NomorSeriDijual }})</td>
					<td style="width: 70px; text-align: right;">Rp. {{ number_format($item->harga_jual) }}</td>
					<td style="width: 70px; text-align: left;">{{ $item->produk_ditukar }} ({{ $item->NomorSeriDitukar }})</td>
					<td style="width: 70px; text-align: right;">Rp. {{ number_format($item->harga_tukar) }}</td>
					<td style="width: 70px; text-align: right;">Rp. {{ number_format($item->sisa_pembayaran) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>