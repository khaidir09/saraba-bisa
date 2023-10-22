<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Transaksi Servis</title>
	<style>
		@page {
            margin: 10mm 5mm; /* Atur margin atas, kanan, bawah, dan kiri */
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
			font-size: 14px;
			line-height: 1em;
			width: 100%;
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
			width: 100%;
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
		<h4 style="margin-bottom: 0">{{ $users->nama_toko }}</h4>
		<p style="margin-top: 3px;">{{ $users->alamat_toko }}</p>
	</div>

	<hr style="border-top: 1px dashed;">

	<div class="text-center">
		<h4 style="margin-bottom: 6px; margin-top: 6px;">
			Laporan Transaksi Servis
		</h4>
		<p style="margin-top: 0">Periode : {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</p>
	</div>
	
	<h4 style="margin-bottom: 6px;">
		<span style="background:color: blue; padding: 6px 12px; border-radius: 50%; color: #fff;">Ringkasan</span>
	</h4>

	<table id="ringkasan">
		<tbody>
			<tr>
				<th>Total Modal Sparepart</th>
				<th style="color: brown">: Rp. {{ number_format($total_modal) }}</th>
				<th>Total Biaya Servis</th>
				<th style="color: blue;">: Rp. {{ number_format($total_biaya) }}</th>
			</tr>
			<tr>
				<th>Total Diskon</th>
				<th style="color: red">: Rp. {{ number_format($total_diskon) }}</th>
				<th>Total Profit</th>
				<th style="color: green">: Rp. {{ number_format($total_profit) }}</th>
			</tr>
		</tbody>
	</table>

	<h4 style="margin-bottom: 12px;">
		<span style="background:color: blue; padding: 6px 12px; border-radius: 50%; color: #fff;">Detail Transaksi</span>
	</h4>

	<table id="detail">
		<thead>
			<tr>
				<th>No.</th>
				<th>Tgl. Masuk</th>
				<th>Tgl. Diambil</th>
				<th>No. Servis</th>
				<th>Pelanggan</th>
				<th>Model Seri</th>
				<th>Tindakan</th>
				<th>Teknisi</th>
				<th>Penyerah</th>
				<th>Modal Sparepart</th>
				<th>Biaya Servis</th>
				<th>Diskon</th>
				<th>Profit Toko</th>
			</tr>
		</thead>
		<tbody>
			@php
				$i = 1
			@endphp
			@foreach ($services as $item)
				<tr>
					<td style="width: 10px;">{{ $i++ }}</td>
					<td style="width: 60px;">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
					<td style="width: 60px;">{{ \Carbon\Carbon::parse($item->tgl_ambil)->format('d-m-Y') }}</td>
					<td class="text-center" style="width: 70px;">{{ $item->nomor_servis }}</td>
					<td style="text-align: left; width: 100px;">{{ $item->nama_pelanggan }}</td>
					<td style="text-align: left; width: 80px;">{{ $item->modelserie->name }}</td>
					<td class="capital" style="text-align: left;">
						@if ($item->kondisi_servis != 'Sudah jadi')
							{{ $item->kondisi_servis }}
						@else
							{{ $item->tindakan_servis }}
						@endif
					</td>
					<td style="text-align: left; width: 70px;">
						@if ($item->users_id != null)
							{{ $item->user->name }}
						@else
							-
						@endif
					</td>
					<td style="text-align: left; width: 70px;">{{ $item->penyerah }}</td>
					<td style="width: 80px; text-align: right;">Rp. {{ number_format($item->modal_sparepart) }}</td>
					<td style="width: 80px; text-align: right;">Rp. {{ number_format($item->biaya) }}</td>
					<td style="width: 60px; text-align: right;">Rp. {{ number_format($item->diskon) }}</td>
					<td style="width: 80px; text-align: right;">Rp. {{ number_format($item->profittoko) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<h4 style="margin-bottom: 6px;">
		<span style="background:color: blue; padding: 6px 12px; border-radius: 50%; color: #fff;">Statistik</span>
	</h4>

	{{-- <table id="analisis">
		<tr>
			<th>No.</th>
			<th>Merek</th>
			<th>Model Seri</th>
			<th>Tindakan</th>
		</tr>
		@php
			$i = 1
		@endphp
		@foreach($topbrands as $brand)
			@foreach($topmodelseries as $model)
				@foreach($topactions as $action)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $brand->brand_name }}</td>
						<td>{{ $model->model_name }}</td>
						<td>{{ $action->action_name }}</td>
					</tr>
				@endforeach
			@endforeach
		@endforeach
	</table> --}}

	<table id="analisis">
		<thead>
			<th>Merek Terbanyak :</th>
		</thead>
		<tbody>
			<tr>
				@php
					$i = 1
				@endphp
				@foreach($topbrands as $count)
					<td>{{ $i++ }}. {{ $count->brand_name }}</td>
				@endforeach
			</tr>
		</tbody>
	</table>

	<table id="analisis">
		<thead>
			<th>Model Serie Terbanyak :</th>
		</thead>
		<tbody>
			<tr>
				@php
					$i = 1
				@endphp
				@foreach($topmodelseries as $count)
					<td>{{ $i++ }}. {{ $count->model_name }}</td>
				@endforeach
			</tr>
		</tbody>
	</table>

	<table id="analisis">
		<thead>
			<th>Tindakan Terbanyak :</th>
		</thead>
		<tbody>
			<tr>
				@php
					$i = 1
				@endphp
				@foreach($topactions as $count)
					<td>{{ $i++ }}. {{ $count->action_name }}</td>
				@endforeach
			</tr>
		</tbody>
	</table>
</body>
</html>