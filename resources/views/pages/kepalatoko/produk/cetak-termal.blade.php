<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
      <title>Nota Penjualan Handphone #{{ $order->invoice_no }}</title>
  </head>
  <body>
    <div class="resi">
      <p class="text-center mb-1">
        NOTA PENJUALAN <br>
        <strong>{{ $users->nama_toko }}</strong> <br>
        Telp/WA {{ $users->nomor_hp_toko }}
      </p>

      <table>
        <tbody>
          <tr>
          <td class="title">No. Invoice</td>
          <td class="value">: {{ $order->invoice_no }}</td>
          </tr>
          <tr>
          <td class="title">Tgl Transaksi</td>
          <td class="value">: {{ $order->order_date }}</td>
          </tr>
          <tr>
          <td class="title">Pelanggan</td>
          <td class="value">: {{ $order->customer->nama }}</td>
          </tr>
          <tr>
          <td class="title">No. HP</td>
          <td class="value">: {{ $order->customer->nomor_hp }}</td>
          </tr>
        </tbody>
      </table>

      <hr style="border-top: 1px dotted; margin: 6px 0;">

      <table>
        <tbody>
          @foreach ($orderItem as $item)
              <tr>
              <td colspan="3">{{ $item->product_name }} {{ $item->product->nomor_seri }} {{ $item->product->keterangan }}</td>
              </tr>
              <tr>
                <td> {{ number_format($item->product->harga_pelanggan) }}</td>
                <td>X {{ $item->quantity }}</td>
                <td>= {{ number_format($item->sub_total) }}</td>                
              </tr>
          @endforeach
        </tbody>
      </table>
      
      <hr style="border-top: 1px dotted; margin: 6px 0 6px;">

      <table>
        <tbody>
          @if ($subtotal === $total)
              <tr>
                <td class="title">Total</td>
                <td class="value">: Rp. {{ number_format($total) }}</td>
              </tr>
          @else
              <tr>
              <td class="title">Sub Total</td>
              <td class="value">: Rp. {{ number_format($subtotal) }}</td>
              </tr>
              <tr>
                <td class="title">Diskon</td>
                <td class="value">: Rp. {{ number_format($subtotal - $total) }}</td>
              </tr>
              <tr>
                <td class="title">Total</td>
                <td class="value">: Rp. {{ number_format($total) }}</td>
              </tr>
          @endif
          <tr>
            <td class="title">Pembayaran</td>
            <td class="value">: Rp. {{ number_format($order->pay) }}</td>
          </tr>
          @if ($order->due > 0)
            <tr>
              <td class="title">Sisa Pembayaran</td>
              <td class="value">: Rp. {{ number_format($order->due) }}</td>
            </tr>
          @endif
        </tbody>
      </table>

      <hr style="border-top: 1px solid; margin: 6px 0 0;">

      <div class="text-center mt-1">
        <small>Dicetak {{ Auth::user()->name }}, <br> [{{ \Carbon\Carbon::now()->translatedFormat('d/m/Y H:i') }} WIB]</small>
        <p class="my-1">Rek {{ $users->bank }} {{ $users->rekening }} <br> a.n. {{ $users->pemilik_rekening }}</p>
        <p class="mb-0">Terima kasih atas kepercayaan Anda telah berbelanja di <br> {{ $users->nama_toko }}</p>
        <p>Barang yang sudah dibeli tidak bisa dikembalikan.</p>
      </div>
    </div>
  </body>
</html>