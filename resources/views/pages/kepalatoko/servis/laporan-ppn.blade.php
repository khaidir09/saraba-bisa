<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <title>Laporan PPN Servis</title>
	<style>
		body {
			color: #000000;
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

		td,
		th,
		tr,
		table {
			border-collapse: collapse;
			font-size: 12px;
			line-height: 1em;
			padding-top: 12px;
			padding-bottom: 12px;
			color: #000000;
			border: 1px solid;
		}

		#data {
			border-bottom: 1px solid #ddd;
		}

	</style>
</head>
<body>
	<div style="font-weight: bold; font-size: 16px;">
		CV Maju Jaya Bahagia <br>
		Laporan Pajak Servis
	</div>
	<table class="w-100">
        <thead>
            <th>Nama Tindakan</th>
            <th>PPN 11%</th>
        </thead>
		<tbody>
			@foreach ($transaksi as $item)
                <tr>
                <td scope="col" class="w-50" style="padding-left: 12px;">{{ $item->tindakan_servis }}</td>
                <td scope="col" class="w-50 text-center">Rp. {{ number_format($item->ppn) }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>
</body>
</html>