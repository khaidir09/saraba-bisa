@section('title')
    Invoice
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <table class="w-full mb-5">
            <thead>
                <tr>
                    <th class="text-left">{{ $customer->nama }}</th>
                    <th class="text-left">No. Nota</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="text-left">{{ $customer->alamat }}</th>
                    <th></th>
                </tr>
                <tr>
                    <th class="text-left">Nomor HP/WA : {{ $customer->nomor_hp }}</th>
                    <th></th>
                </tr>
            </tbody>
        </table>

        <table class="border-collapse border border-slate-500 w-full">
            <thead>
                <tr>
                <th class="border border-slate-600">#</th>
                <th class="border border-slate-600">Item</th>
                <th class="border border-slate-600">Jumlah</th>
                <th class="border border-slate-600">Harga</th>
                <th class="border border-slate-600">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($contents as $item)
                <tr>
                    <td class="border border-slate-700">{{ $i++ }}</td>
                    <td class="border border-slate-700">{{ $item->name }}</td>
                    <td class="border border-slate-700">{{ $item->qty }}</td>
                    <td class="border border-slate-700">{{ $item->price }}</td>
                    <td class="border border-slate-700">{{ $item->qty*$item->price }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3"></td>
                    <td>Sub Total</td>
                    <td>{{ Cart::subtotal() }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</x-toko-layout>