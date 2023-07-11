<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
        color: #000000;
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
    .thanks p {
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding: 10px 10px 0 10px;">
    <tr>
        <td align="top"><img src="{{ asset('images/logo-toko.jpg') }}" alt="" width="150"/>
          
          <h2 style="font-size: 18px;">
            <strong>{{ $users->nama_toko }}</strong> <br>
            {{ $users->deskripsi_toko }}
          </h2>
        </td>
        <td align="right">
            <pre class="font" >
               {{ $users->alamat_toko }} <br>
               Telp/WA {{ $users->nomor_hp_toko }} <br>
            </pre>
        </td>
    </tr>
  </table>

  <table width="100%" style="background:white; padding:2px;"></table>

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

  <table width="100%" style="margin-top: 15px;">
    <thead style="background-color: lightgrey;">
      <tr class="font">
        <th>No.</th>
        <th>Nama Produk</th>
        <th>Garansi</th>
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
        <td align="center">{{ $item->product->product_name }}</td>
        @if ($item->garansi != null)
            <td align="center">Aktif s/d {{ $item->garansi }}</td>
        @else
            <td align="center">Tidak ada</td>
        @endif
        <td align="center">Rp. {{ number_format($item->product->harga_jual) }}</td>
        <td align="center">{{ $item->quantity }}</td>
        <td align="center">Rp. {{ number_format($item->product->harga_jual * $item->quantity) }}</td>
        @if ($item->sub_total === $item->total)
            <td align="center">Tidak ada</td>
        @else
            <td align="center">{{ $persen }}% (Rp. {{ number_format($item->sub_total - $item->total) }})</td>
        @endif
        <td align="center">Rp. {{ number_format($item->total) }}</td>

      </tr>
      @endforeach
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2>
              <span>Total:</span> Rp. {{ number_format($total) }}
            </h2>
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <h4>Syarat & Ketentuan</h4>
    <p>{!! $terms->description !!}</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>{{ Auth::user()->name }}</h5>
    </div>
</body>
</html>