@section('title')
    Pengecekan Status Garansi HP
@endsection

<x-customer.header :users="$users"/>

<x-customer-layout>
    <!-- Content -->
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Status Garansi HP ✨</h1>
            </div>

        </div>

        <div class="space-y-2">
            @foreach ($phone_transaction as $item)
                <div class="shadow-lg rounded-sm border px-5 py-4 bg-white border-slate-200">
                    <div class="md:flex justify-between items-center space-y-4 md:space-y-0">
                        <!-- Left side -->
                        <div class="flex items-start space-x-3 md:space-x-4">                             
                            <div>
                                <div class="text-xs font-semibold text-blue-600">{{ $item->nomor_transaksi }}</div>
                                <div class="inline-flex font-semibold text-slate-800">{{ $item->phone->brand->name }} {{ $item->phone->modelserie->name }} ({{ $item->phone->warna }}/{{ $item->phone->kapasitas }})</div>
                                <div class="text-sm">{{ $item->phone->kondisi }} @if ($item->phone->keterangan != null) • {{ $item->phone->keterangan }} @endif • {{ $item->phone->kelengkapan }}</div>
                                <div class="text-sm">Fungsi {{ $item->qc }}</div>
                            </div>
                        </div>
                        <!-- Right side -->
                        <div class="flex flex-col md:flex-row items-start space-y-1 md:space-y-0 md:space-x-4">
                            <div class="text-xs inline-flex font-medium rounded-full text-center px-2.5 py-1 bg-emerald-100 text-emerald-600">Rp. {{ number_format($item->harga - $item->diskon) }}</div>
                            <div class="text-sm text-slate-500 italic whitespace-nowrap">
                                Tgl. Pembelian {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                            </div>
                            @if ($item->exp_garansi === null)
                                <div class="text-sm text-red-600 italic">
                                    Garansi HP Tidak Ada
                                </div>
                            @elseif ($item->exp_garansi < \Carbon\Carbon::now())
                                <div class="text-sm text-red-600 italic">
                                    Garansi HP Sudah Kedaluwarsa {{ \Carbon\Carbon::parse($item->exp_garansi)->translatedFormat('d M Y') }}
                                </div>
                            @else
                                <div class="text-sm text-blue-600">Garansi HP Aktif s/d {{ \Carbon\Carbon::parse($item->exp_garansi)->translatedFormat('d M Y') }}</div>
                            @endif
                            @if ($item->exp_imei === null)
                                <div class="text-sm text-red-600 italic">
                                    Garansi IMEI Tidak Ada
                                </div>
                            @elseif ($item->exp_imei < \Carbon\Carbon::now())
                                <div class="text-sm text-red-600 italic">
                                    Garansi IMEI Sudah Kedaluwarsa {{ \Carbon\Carbon::parse($item->exp_imei)->translatedFormat('d M Y') }}
                                </div>
                            @else
                                <div class="text-sm text-blue-600">Garansi IMEI Aktif s/d {{ \Carbon\Carbon::parse($item->exp_imei)->translatedFormat('d M Y') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-customer-layout>