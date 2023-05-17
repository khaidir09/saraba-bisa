@section('title')
    Dashboard Kepala Toko
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <!-- Welcome banner -->
        <x-dashboard.welcome-banner :totalomzet="$totalomzet" :totalprofitutuh="$totalprofitutuh"/>

        <!-- Banner -->
        <div class="mb-6">
            <div class="space-y-3">
                <!-- Start -->
                @if ($approveservis != null)
                    <div class="px-4 py-2 rounded-sm text-sm bg-emerald-500 text-white">
                        <div class="flex w-full justify-between items-start">
                            <div class="flex">
                                <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
                                    <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm1 12H7V7h2v5zM8 6c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z" />
                                </svg>
                                <div class="font-medium">Hore! Ada {{ $approveservis }} transaksi servis selesai nih, cek sekarang!</div>
                            </div>
                            <a class="font-medium text-white ml-4 mt-[3px]" href="{{ route('transaksi-servis-sudah-diambil.index') }}">-&gt;</a>
                        </div>
                    </div>
                @endif
                <!-- End -->
                <!-- Start -->
                @if ($approvehandphone != null)
                    <div class="px-4 py-2 rounded-sm text-sm bg-indigo-500 text-white">
                        <div class="flex w-full justify-between items-start">
                            <div class="flex">
                                <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
                                    <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm1 12H7V7h2v5zM8 6c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z" />
                                </svg>
                                <div class="font-medium">Hore! Ada {{ $approvehandphone }} transaksi handphone baru nih, cek sekarang!</div>
                            </div>
                            <a class="font-medium text-white ml-3 mt-[3px]" href="{{ route('transaksi-handphone.index') }}">-&gt;</a>
                        </div>
                    </div>
                @endif
                <!-- End -->
                <!-- Start -->
                @if ($approveaksesoris != null)
                    <div class="px-4 py-2 rounded-sm text-sm bg-indigo-500 text-white">
                        <div class="flex w-full justify-between items-start">
                            <div class="flex">
                                <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
                                    <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm1 12H7V7h2v5zM8 6c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z" />
                                </svg>
                                <div class="font-medium">Hore! Ada {{ $approveaksesoris }} transaksi aksesori baru nih, cek sekarang!</div>
                            </div>
                            <a class="font-medium text-white ml-3 mt-[3px]" href="{{ route('transaksi-aksesoris.index') }}">-&gt;</a>
                        </div>
                    </div>
                @endif
                <!-- End -->
                <!-- Start -->
                @if ($approvesparepart != null)
                    <div class="px-4 py-2 rounded-sm text-sm bg-indigo-500 text-white">
                        <div class="flex w-full justify-between items-start">
                            <div class="flex">
                                <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
                                    <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm1 12H7V7h2v5zM8 6c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z" />
                                </svg>
                                <div class="font-medium">Hore! Ada {{ $approvesparepart }} transaksi sparepart baru nih, cek sekarang!</div>
                            </div>
                            <a class="font-medium text-white ml-3 mt-[3px]" href="{{ route('transaksi-sparepart.index') }}">-&gt;</a>
                        </div>
                    </div>
                @endif
                <!-- End -->
                <!-- Start -->
                @if ($approvekasbon != null)
                    <div class="px-4 py-2 rounded-sm text-sm bg-amber-500 text-white">
                        <div class="flex w-full justify-between items-start">
                            <div class="flex">
                                <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
                                    <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm1 12H7V7h2v5zM8 6c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z" />
                                </svg>
                                <div class="font-medium">Ada {{ $approvekasbon }} kasbon menunggu persetujuan, cek sekarang!</div>
                            </div>
                            <a class="font-medium text-white ml-3 mt-[3px]" href="{{ route('kasbon.index') }}">-&gt;</a>
                        </div>
                    </div>
                @endif
                <!-- End -->
                <!-- Start -->
                @if ($approvepengeluaran != null)
                    <div class="px-4 py-2 rounded-sm text-sm bg-amber-500 text-white">
                        <div class="flex w-full justify-between items-start">
                            <div class="flex">
                                <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
                                    <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm1 12H7V7h2v5zM8 6c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z" />
                                </svg>
                                <div class="font-medium">Ada {{ $approvepengeluaran }} pengeluaran menunggu persetujuan, cek sekarang!</div>
                            </div>
                            <a class="font-medium text-white ml-3 mt-[3px]" href="{{ route('pengeluaran.index') }}">-&gt;</a>
                        </div>
                    </div>
                @endif
                <!-- End -->
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            {{-- Progres --}}
            <div class="flex flex-col col-span-full xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                <header class="px-5 py-4 border-b border-slate-100">
                    <h2 class="font-semibold text-slate-800">Progres Target Bulanan</h2>
                </header>
                <div class="h-full flex flex-col px-5 py-3">
                    <!-- Circle -->
                    @php
                        $circumference = 30 * 2 * pi();
                        $percent = round(($totalprofit / $totalbudgets) * 100);
                    @endphp
                    <div class="inline-flex items-center justify-center overflow-hidden rounded-full">
                        <svg class="w-20 h-20">
                            <circle
                            class="text-gray-300"
                            stroke-width="5"
                            stroke="currentColor"
                            fill="transparent"
                            r="30"
                            cx="40"
                            cy="40"
                            />
                            <circle
                            class="text-blue-600"
                            stroke-width="5"
                            stroke-dasharray="{{ $circumference }}"
                            stroke-dashoffset="{{ $circumference - $percent / 100 * $circumference }}"
                            stroke-linecap="round"
                            stroke="currentColor"
                            fill="transparent"
                            r="30"
                            cx="40"
                            cy="40"
                            />
                        </svg>
                        <span class="absolute text-xl text-blue-700">{{ $percent }}%</span>
                    </div>
                    <div class="text-xl font-bold text-slate-800 text-center">Rp. {{ number_format($totalprofit) }} / Rp. {{ number_format($totalbudgets) }}</div>
                    @if ($totalprofit < $totalbudgets)
                        <p class="text-center mt-2 text-sm font-semibold text-blue-700">Tingkatkan profit hingga <span class="text-red-600">Rp. {{ number_format($totalbudgets - $totalprofit) }}</span> lagi!</p>
                    @else
                        <p class="text-center mt-2 text-sm font-semibold text-blue-700">Selamat kamu sudah <span class="text-green-600">BERHASIL</span> mencapai target! Profit toko sekarang lebih Rp. {{ number_format($totalprofit - $totalbudgets) }} dari target 👏🏻</p>
                    @endif
                </div>
            </div>
             {{-- Profit Servis --}}
            <div class="flex flex-col col-span-full xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                <header class="px-5 py-4 border-b border-slate-100">
                    <h2 class="font-semibold text-slate-800">Profit Servis</h2>
                </header>
                <div class="flex flex-col h-full">
                    <div class="px-5 py-3">
                        <div class="flex items-center">
                            <div class="relative flex items-center justify-center w-4 h-4 rounded-full bg-green-100 mr-3"
                                aria-hidden="true">
                                <div class="absolute w-1.5 h-1.5 rounded-full bg-green-500"></div>
                            </div>
                            <div>
                                <div class="text-xl font-bold text-slate-800 mr-2">Rp. {{ number_format($totalbiayaservis) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="grow px-5 pt-0 pb-1">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs uppercase text-slate-400">
                                <tr>
                                    <th class="py-2">
                                        <div class="font-semibold text-left">Item</div>
                                    </th>
                                    <th class="py-2">
                                        <div class="font-semibold text-right">Profit</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-slate-100">
                                @foreach ($types as $item)
                                    <tr>
                                        <td class="py-2">
                                            <div class="text-left">{{ $item->name }}</div>
                                        </td>
                                        <td class="py-2">
                                            <div class="font-medium text-right text-slate-800">Rp. {{ number_format($item->service->sum('profittoko')) }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profit Penjualan --}}
            <div class="flex flex-col col-span-full xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                <header class="px-5 py-4 border-b border-slate-100">
                    <h2 class="font-semibold text-slate-800">Profit Penjualan</h2>
                </header>
                <div class="flex flex-col h-full">
                    <div class="px-5 py-3">
                        <div class="flex items-center">
                            <div class="relative flex items-center justify-center w-4 h-4 rounded-full bg-blue-100 mr-3"
                                aria-hidden="true">
                                <div class="absolute w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                            </div>
                            <div>
                                <div class="text-xl font-bold text-slate-800 mr-2">Rp. {{ number_format($totalpenjualan) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="grow px-5 pt-0 pb-1">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs uppercase text-slate-400">
                                <tr>
                                    <th class="py-2">
                                        <div class="font-semibold text-left">Item</div>
                                    </th>
                                    <th class="py-2">
                                        <div class="font-semibold text-right">Profit</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-slate-100">
                                <tr>
                                    <td class="py-2">
                                        <div class="text-left">Aksesori</div>
                                    </td>
                                    <td class="py-2">
                                        <div class="font-medium text-right text-slate-800">Rp. {{ number_format($totalaksesoris) }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2">
                                        <div class="text-left">Handphone</div>
                                    </td>
                                    <td class="py-2">
                                        <div class="font-medium text-right text-slate-800">Rp. {{ number_format($totalhandphone) }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2">
                                        <div class="text-left">Sparepart</div>
                                    </td>
                                    <td class="py-2">
                                        <div class="font-medium text-right text-slate-800">Rp. {{ number_format($totalsparepart) }}</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-toko-layout>
