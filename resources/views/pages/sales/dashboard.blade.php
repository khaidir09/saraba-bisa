@section('title')
    Dashboard Sales
@endsection

<x-sales-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Page Intro -->                     
             <x-sales.header-sales :totalbonus="$totalbonus"/>

            <div class="flex flex-col col-span-full xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                <header class="px-5 py-4 border-b border-slate-100">
                    <h2 class="font-semibold text-slate-800">Progres Target Bulanan</h2>
                </header>
                <div class="h-full flex flex-col px-5 py-3">
                    <!-- Circle -->
                    @php
                        $circumference = 30 * 2 * pi();
                        $percent = round(($result / $target) * 100);
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
                    <div class="text-xl font-bold text-slate-800 text-center">{{ $result }} item / {{ $target }} item</div>
                    @if ($result < $target)
                        <p class="text-center mt-2 text-sm font-semibold text-blue-700">Tingkatkan penjualan hingga <span class="text-red-600">{{ $target - $result }}</span> item lagi!</p>
                    @else
                        <p class="text-center mt-2 text-sm font-semibold text-blue-700">Selamat kamu sudah <span class="text-green-600">BERHASIL</span> mencapai target! Item penjualanmu sekarang lebih {{ $result - $target }} dari target 👏🏻</p>
                    @endif
                </div>
            </div>

        </div>

    </div>
</x-sales-layout>