@section('title')
    Detail Transaksi Produk
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
     
        <!-- Billing Information -->
        <div class="mb-6">
            <div class="text-slate-800 font-semibold mb-4">Data Pelanggan</div>
            <form>
                <div class="space-y-4">
                    <!-- 1st row -->
                    <div class="md:flex space-y-4 md:space-y-0 md:space-x-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium mb-1" for="card-name">Nama</label>
                            <input id="card-name" class="form-input w-full" type="text" value="{{ $order->customer->nama }}" disabled/>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium mb-1" for="card-surname">Nomor HP</label>
                            <input id="card-surname" class="form-input w-full" type="text" value="{{ $order->customer->nomor_hp }}" disabled/>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="max-w-sm mx-auto lg:max-w-none">
            <div class="space-y-6">

                <!-- Order Details -->
                <div>
                    <div class="text-slate-800 font-semibold mb-2">Detail Transaksi</div>
                    <!-- Cart items -->
                    <ul>
                        <!-- Cart item -->
                        @foreach ($orderItem as $item)
                            <li class="flex items-center py-3 border-b border-slate-200">
                                <div class="grow">
                                    <a href="#0">
                                        <h4 class="text-sm font-medium text-slate-800 leading-tight">{{ $item->product->product_name }} (Rp. {{ number_format($item->price) }} x {{ $item->quantity }}
                                            @if ($item->quantity == 1)
                                                pc
                                            @else
                                                pcs
                                            @endif)
                                        </h4>
                                    </a>
                                </div>
                                <div class="text-sm font-medium text-slate-800 ml-6">Rp. {{ number_format($item->total) }}</div>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Fees, discount and total -->
                    <ul>
                        <li class="flex items-center justify-between py-3 border-b border-slate-200">
                            <div class="text-sm">Subtotal</div>
                            <div class="text-sm font-medium text-slate-800 ml-2">
                                Rp. {{ number_format($subtotal) }}
                            </div>
                        </li>
                        <li class="flex items-center justify-between py-3 border-b border-slate-200">
                            <div class="flex items-center">
                                <span class="text-sm mr-2">Diskon</span>
                            </div>
                            <div class="text-sm font-medium text-slate-800 ml-2">-$25</div>
                        </li>
                        <li class="flex items-center justify-between py-3 border-b border-slate-200">
                            <div class="text-sm">Total</div>
                            <div class="text-sm font-medium text-emerald-600 ml-2">$205</div>
                        </li>
                    </ul>
                </div>

                <!-- Payment Details -->
                <div>
                    <div class="text-slate-800 font-semibold mb-4">Detail Pembayaran</div>
                    <div class="text-sm rounded border border-slate-200 p-3 space-y-3">
                        @if ($order->due == 0)
                            <div class="flex items-center justify-between space-x-2">
                                <!-- CC details -->
                                <div>{{ $order->payment_method }}</div>
                                <!-- Expiry -->
                                <div class="italic ml-2">{{ number_format($order->pay) }}</div>
                            </div>
                        @else
                            <div class="flex items-center justify-between space-x-2">
                                <!-- CC details -->
                                <div>{{ $order->payment_method }}</div>
                                <!-- Expiry -->
                                <div class="italic ml-2">Rp. {{ number_format($order->pay) }}</div>
                            </div>
                            <div class="flex items-center justify-between space-x-2">
                                <!-- CC details -->
                                <div>Sisa Pembayaran</div>
                                <!-- Expiry -->
                                <div class="italic ml-2">Rp. {{ number_format($order->due) }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-6">
                    <div class="mb-4">
                        <a href="{{ route('lunas-cetak-inkjet', $item->id) }}" class="btn w-full bg-indigo-500 hover:bg-indigo-600 text-white">Cetak Invoice</a>
                    </div>
                    {{-- <div class="text-xs text-slate-500 italic text-center">Should you ever change your mind, we offer a 14-day, no-questions-asked refund policy.</div> --}}
                </div>

            </div>
        </div>

    </div>
</x-toko-layout>
