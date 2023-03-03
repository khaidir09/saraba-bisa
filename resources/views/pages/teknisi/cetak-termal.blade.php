<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>Tanda Terima Servis #{{ $items->nomor_servis }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		body {
			font-family: 'DejaVu Sans Mono';
		}
	</style>
</head>
<body style="font-size: 12px;">
  		<table width="96%">
  			<tr>
  				<td align="center">TANDA TERIMA SERVIS</td>
  			</tr>
  			<tr>
  				<td align="center" style="font-size: 15px;"><b>HAIRIL IDEVICE</b></td>
  			</tr>
  			<tr>
  				<td align="center" style="padding-bottom: 4px;">Telp/WA 082220034447</td>
  			</tr>
  		</table>
  		<hr style="border-top: 1px solid; margin: 0px;">
  		<table width="96%">
  			<tr>
  				<td width="54">No. Servis</td>
  				<td width="4">:</td>
  				<td>{{ $items->nomor_servis }}</td>
  			</tr>
			<tr>
  				<td>Tanggal</td>
  				<td>:</td>
  				<td>{{ \Carbon\Carbon::parse($items->created_at)->format('d/m/Y') }}</td>
  			</tr>
  			<tr>
  				<td>Kerusakan</td>
  				<td>:</td>
  				<td>{{ $items->kerusakan }}</td>
  			</tr>
			<tr>
  				<td>Estimasi Biaya</td>
  				<td>:</td>
  				<td>Rp. {{ number_format($items->estimasi_biaya) }}</td>
  			</tr>
			<tr>
  				<td>Estimasi Pengerjaan</td>
  				<td>:</td>
  				<td>{{ $items->estimasi_pengerjaan }}</td>
  			</tr>
			<tr>
  				<td>Nama Barang</td>
  				<td>:</td>
  				<td>{{ $items->type->name }} {{ $items->brand->name }} {{ $items->modelserie->name }}</td>
  			</tr>
			<tr>
  				<td>IMEI/SN</td>
  				<td>:</td>
  				<td>{{ $items->imei }}</td>
  			</tr>
			<tr>
  				<td>Warna/Kapasitas</td>
  				<td>:</td>
  				<td>{{ $items->warna }} {{ $items->capacity->name }}</td>
  			</tr>
			<tr>
  				<td>Pelanggan</td>
  				<td>:</td>
  				<td>{{ $items->customer->nama }}</td>
  			</tr>
			<tr>
  				<td>Nomor HP</td>
  				<td>:</td>
  				<td>{{ $items->customer->nomor_hp }}</td>
  			</tr>
  		</table>
  		<table width="96%">
  			<tr>
  				<td align="center" style="padding-top: 4px;"><div id="qrcodethermal"></div></td>
  			</tr>
  			<tr>
  				<td align="center" style="font-size: 11px;">Scan QR Code ini untuk Cek Online</td>
  			</tr>
  		</table>
  		<hr style="border-top: 1px solid; margin: 0px;">
  		<table width="96%" style="font-size: 11px;">
  			<tr>
  				<td style="padding-bottom: 2px;">
            Dicetak Admin [10/01/2023 23:16 WIB]          </td>
  			</tr>
  			<tr>
  				<td align="center">Silahkan bawa Nota Tanda Terima Servis</td>
  			</tr>
  			<tr>
  				<td align="center">ini pada saat pengambilan barang.</td>
  			</tr>
  			<tr>
  				<td align="center">Terima kasih.</td>
  			</tr>
  		</table>
		<table width="96%" class="mt-5">
  			<tr>
  				<td align="center" style="font-size: 15px;"><b>Pengecekan Masuk/Keluar Servis</b></td>
  			</tr>
  		</table>
		<table class="table table-bordered table-sm text-center mt-3">
			<thead>
				<tr>
				<th scope="col">Item</th>
				<th scope="col">Masuk</th>
				<th scope="col">Keluar</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<th scope="row">Face ID/Finger</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Kamera Depan</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Kamera Belakang</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Speaker Atas</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Speaker Bawah</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Housing</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">LCD</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Jaringan</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Baterai</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Mikrofon</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Audio</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Wifi</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Flash LED</th>
				<td></td>
				<td></td>
				</tr>
				<tr>
				<th scope="row">Semua Tombol</th>
				<td></td>
				<td></td>
				</tr>
			</tbody>
		</table>
		<table class="table table-borderless table-sm text-center mt-3">
			<thead>
				<tr>
				<th scope="col">Kasir/Teknisi</th>
				<th scope="col">Pelanggan</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<th scope="row"></th>
				<td></td>
				</tr>
				<tr>
				<th scope="row"></th>
				<td></td>
				</tr>
				<tr>
				<th scope="row">..........</th>
				<td>..........</td>
				</tr>
			</tbody>
		</table>
</body>
</html>