@section('title')
    Invoice
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <table class="w-full mb-5">
            <tbody>
                <tr>
                    <th class="text-left">{{ $user->nama_toko}}</th>
                    <th colspan="2" class="text-center text-uppercase">No. Invoice : {{ $no_invoice }}</th>
                </tr>
                <tr>
                    <th class="text-left">{{ $user->deskripsi_toko }}</th>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-left">{{ $user->alamat_toko }}</td>
                    <th class="text-center border border-slate-700">Tanggal</th>
                    <th class="text-center border border-slate-700">Sales</th>
                </tr>
                <tr>
                    <td class="text-left">Telp/WA {{ $user->nomor_hp_toko }}</td>
                    <td class="text-center border border-slate-700">{{ \Carbon\Carbon::now()->translatedFormat('d-m-Y, H:i') }}</td>
                    <td class="text-center border border-slate-700">{{ Auth::user()->name }}</td>
                </tr>
            </tbody>
        </table>

        <div class="my-3">
            <p class="font-semibold">Pelanggan : <span class="font-normal">{{ $customer->nama }}</span></p>
            <p class="font-semibold">Telp/WA : <span class="font-normal">{{ $customer->nomor_hp }}</span></p>
        </div>

        <table class="border-collapse border border-slate-500 w-full">
            <thead>
                <tr>
                <th class="border border-slate-600">No.</th>
                <th class="border border-slate-600">Nama Barang</th>
                <th class="border border-slate-600">Jumlah</th>
                <th class="border border-slate-600">Harga</th>
                <th class="border border-slate-600">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($contents as $item)
                <tr>
                    <td class="border border-slate-700 text-center">{{ $i++ }}</td>
                    <td class="border border-slate-700 px-3">{{ $item->name }}</td>
                    <td class="border border-slate-700 text-center">{{ $item->qty }}</td>
                    <td class="border border-slate-700 text-center">{{ number_format($item->price) }}</td>
                    <td class="border border-slate-700 text-center">{{ number_format($item->qty*$item->price) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="2" class="border border-slate-700 text-center">Total Barang</th>
                    <td class="border border-slate-700 text-center">{{ Cart::count() }}</td>
                    <th class="border border-slate-700 text-center">Total Harga</th>
                    <td class="border border-slate-700 text-center">{{ Cart::subtotal() }}</td>
                </tr>
            </tbody>
        </table>

        <table class="mt-10 w-full text-center table-fixed">
            <thead>
                <tr>
                    <th class="w-1/2">Pelanggan</th>
                    <th class="w-1/2">Tertanda</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="pt-20">{{ $customer->nama }}</td>
                    <td class="pt-20">{{ Auth::user()->name }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</x-toko-layout>