<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Nota Pengambilan Servis #{{ $items->nomor_servis }}</title>
	<style>
		body {
			color: #000000;
		}

		.capital {
			text-transform: uppercase;
		}

		.nama-toko {
			font-size: 72px;
			font-weight: 800;
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

	<h6 class="text-center">NOTA PENGAMBILAN SERVIS</h6>

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
					<td>: {{ $items->imei }}</td>
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
					<th colspan="2" style="border-left-style: solid;">Tindakan</th>
					<th colspan="2" style="border-left-style: solid;">Pengecekan (Tombol, Kamera, dll)</th>
					<th colspan="2" style="border-left-style: solid;">Pembayaran</th>
				</tr>
			</thead>
			<tbody>
				<tr style="border-right-style: solid;">
					<td scope="row" style="border-left-style: solid;">Kerusakan</th>
					<td class="capital">: {{ $items->kerusakan }}</td>
					<td scope="row" style="border-left-style: solid;">Fungsi (Masuk)</th>
					<td class="capital">: {{ $items->qc_masuk }}</td>
					<td scope="row" style="border-left-style: solid;">Metode Pembayaran</td>
					<td class="capital">: {{ $items->cara_pembayaran }}</td>
				</tr>
				<tr style="border-right-style: solid;">
					<td scope="row" style="border-left-style: solid;">Kondisi Servis</th>
					<td class="capital">: {{ $items->kondisi_servis }}</td>
					<td scope="row" style="border-left-style: solid;">Fungsi (Keluar)</th>
					<td class="capital">: {{ $items->qc_keluar }}</td>
					<td scope="row" style="border-left-style: solid;">Biaya Servis</td>
					<td>: Rp. {{ number_format($items->biaya) }}</td>
				</tr>
				@if ($items->uang_muka != null && $items->diskon != null)
					<tr style="border-right-style: solid;">
						<td scope="row" style="border-left-style: solid;">Tindakan Servis</td>
						<td class="capital">: {{ $items->tindakan_servis }}</td>
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;">Uang Muka</td>
						<td>: Rp. {{ number_format($items->uang_muka) }}</td>
					</tr>
					<tr style="border-right-style: solid;">
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;">Diskon</td>
						<td>: Rp. {{ number_format($items->diskon) }}</td>
					</tr>
					<tr style="border-bottom-style: solid; border-right-style: solid;">
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;">Sisa Pembayaran</td>
						<td>: Rp. {{ number_format($items->biaya - $items->uang_muka - $items->diskon) }}</td>
					</tr>
				@elseif ($items->uang_muka != null && $items->diskon === null)
					<tr style="border-right-style: solid;">
						<td scope="row" style="border-left-style: solid;">Tindakan Servis</td>
						<td class="capital">: {{ $items->tindakan_servis }}</td>
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;">Uang Muka</td>
						<td>: Rp. {{ number_format($items->uang_muka) }}</td>
					</tr>
					<tr style="border-bottom-style: solid; border-right-style: solid;">
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;">Sisa Pembayaran</td>
						<td>: Rp. {{ number_format($items->biaya - $items->uang_muka) }}</td>
					</tr>
				@elseif ($items->diskon != null && $items->uang_muka === null)
					<tr style="border-right-style: solid;">
						<td scope="row" style="border-left-style: solid;">Tindakan Servis</td>
						<td class="capital">: {{ $items->tindakan_servis }}</td>
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;">Diskon</td>
						<td>: Rp. {{ number_format($items->diskon) }}</td>
					</tr>
					<tr style="border-bottom-style: solid; border-right-style: solid;">
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;">Sisa Pembayaran</td>
						<td>: Rp. {{ number_format($items->biaya - $items->diskon) }}</td>
					</tr>
				@elseif ($items->diskon === null && $items->uang_muka === null)
					<tr style="border-right-style: solid; border-bottom-style: solid;">
						<td scope="row" style="border-left-style: solid;">Tindakan Servis</td>
						<td class="capital">: {{ $items->tindakan_servis }}</td>
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
						<td scope="row" style="border-left-style: solid;"></td>
						<td></td>
					</tr>
				@endif
			</tbody>
		</table>
		<table class="table table-sm table-borderless">
			<thead>
				<tr>
					@if ($items->exp_garansi === null)
						<td>
							Tidak ada garansi untuk tindakan servis ini.
						</td>
					@else
						<td>
							Garansi servis Anda aktif sampai tanggal {{ $items->exp_garansi }}
						</td>
					@endif
				</tr>
				<tr>
					<th class="w-50">Syarat & Ketentuan</th>
					<th colspan="2" class="text-center w-25">Pengambil</th>
					<th colspan="2" class="text-center w-25">Tertanda</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-justify" style="font-style: italic;">
						{!! $terms->description !!} <br> <br>
						<span style="font-weight: bold;">Terima kasih atas kepercayaan Anda telah melakukan Servis di {{ $users->nama_toko }}</span>
					</td>
					<td colspan="2" class="pt-5 text-center">{{ $items->customer->nama }}</td>
					<td colspan="2" class="pt-5 text-center">{{ Auth::user()->name }}</td>
				</tr>
			</tbody>
		</table>
	</section>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>