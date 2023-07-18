<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        /*text-align: center;*/
        margin-left: 35px;
    }

    .informasi-toko {
      text-align: center;
    }

    .w-50 {
			width: 50%;
		}

		.w-25 {
			width: 25%;
		}

    .text-center {
			text-align: center;
		}
		.text-left {
			text-align: left;
		}
		.text-justify {
			text-align: justify;
		}
</style>

</head>
<body>

  @php
		function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		}
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
	@endphp

  <div class="informasi-toko">
    @if ($users->profile_photo_path != null)
      <img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" alt="" height="70" class="mt-1 mb-2">
    @endif
    <h2 style="font-size: 18px;">
      <strong>{{ $users->nama_toko }}</strong> <br>
      {{ $users->deskripsi_toko }}
    </h2>
    <p>
      {{ $users->alamat_toko }} <br>
      Telp/WA {{ $users->nomor_hp_toko }} <br>
    </p>
  </div>

  <table width="100%" style="background: #F7F7F7; padding: 10px;" class="font">
    <tr>
        <td>Nama Pelanggan</td>
        <td>: {{ $order->customer->nama }}</td>
        <td>No. Invoice</td>
        <td>: {{ $order->invoice_no }}</td>
    </tr>
    <tr>
        <td>Telp/WA</td>
        <td>: {{ $order->customer->nomor_hp }}</td>
        <td>Tanggal Transaksi</td>
        <td>: {{ $order->order_date }}</td>
    </tr>
    <tr>
        <td>Kategori Pelanggan</td>
        <td>: {{ $order->customer->kategori }}</td>
        <td>Metode Pembayaran</td>
        <td>: {{ $order->payment_method }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Total Pembayaran</td>
        <td>: Rp. {{ number_format($order->pay) }}</td>
    </tr>
    @if ($order->due > 0)
        <tr>
            <td></td>
            <td></td>
            <td>Sisa Pembayaran</td>
            <td>: Rp. {{ number_format($order->due) }}</td>
        </tr>
    @endif
  </table>

  <table width="100%" style="margin-top: 15px; border: 1px solid; border-collapse: collapse;">
    <thead style="background-color: lightgrey;">
      <tr class="font">
        <th>No.</th>
        <th>Nama Produk</th>
        <th>Garansi Produk</th>
        @if ($orderItem->first()->garansi_imei != null)
            <th>Garansi IMEI</th>
        @endif
        <th>Harga</th>
        <th>Quantity</th>
        <th>Total Harga</th>
        <th>Diskon</th>
        <th>Sub Total</th>
      </tr>
    </thead>
    <tbody>
    @php
      $i = 0;
    @endphp
     @foreach($orderItem as $item)
      <tr class="font">
        <td align="center">
          {{ ++$i }}
        </td>
        <td align="center" style="text-transform: uppercase;">{{ $item->product->product_name }}</td>
        @if ($item->garansi != null)
            <td align="center">Aktif s/d {{ $item->garansi }}</td>
        @else
            <td align="center">Tidak ada</td>
        @endif
        @if ($item->garansi_imei != null)
            <td align="center">Aktif s/d {{ $item->garansi_imei }}</td>
        @else
          <td align="center"></td>
        @endif
        <td align="center">Rp. {{ number_format($item->product->harga_jual) }}</td>
        <td align="center">{{ $item->quantity }}</td>
        <td align="center">Rp. {{ number_format($item->product->harga_jual * $item->quantity) }}</td>
        @if ($item->sub_total === $item->total)
            <td align="center">Tidak ada</td>
        @else
            <td align="center">Rp. {{ number_format($item->sub_total - $item->total) }}</td>
        @endif
        <td align="center">Rp. {{ number_format($item->total) }}</td>

      </tr>
      @endforeach
    </tbody>
  </table>
  <table width="100%">
    <tr>
        <td align="right" >
            <h2>
              <span>Total:</span> Rp. {{ number_format($total) }} <br> <span style="text-transform: capitalize; font-size: 12px; font-weight: normal;">( {{ terbilang($total) }} rupiah )</span>
            </h2>
        </td>
    </tr>
  </table>
  <table>
    <thead>
      <tr>
        <th class="w-50 text-left">Syarat & Ketentuan</th>
        <th colspan="2" class="text-center w-25">Pembeli</th>
        <th colspan="2" class="text-center w-25">Penjual</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-justify" style="font-style: italic;">
          {!! $termpenjualan->description !!} <br>
        </td>
        <td colspan="2" class="pt-5 text-center capital">{{ $order->customer->nama }}</td>
        @if ($item->user != null)
          <td colspan="2" class="pt-5 text-center capital">{{ Auth::user()->name }}</td>
        @else
          <td colspan="2" class="pt-5 text-center capital">-</td>
        @endif
      </tr>
    </tbody>
  </table>
  @if ($orderItem->first()->garansi != null)
    <div>
      <p style="font-size: x-small; text-decoration: underline;">Cek status garansi di {{ $users->link_toko }}/garansi</p>
    </div>
  @endif
</body>
</html>