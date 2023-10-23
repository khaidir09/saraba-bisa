<div class="flex flex-col col-span-full xl:col-span-4 bg-gradient-to-b from-slate-700 to-slate-800 shadow-lg rounded-sm border border-slate-800">
    <header class="px-5 py-4 border-b border-slate-600 flex items-center">
        <h2 class="font-semibold text-slate-200">Progres Target Bulanan</h2>
    </header>
    <div class="h-full flex flex-col px-5 py-6">
        <!-- Details -->
        <div class="flex flex-col justify-center">
            <div class="space-y-2">
                <div>
                    @php
                        $totalprofit = $totalbiayaservis - $totalmodalservis - $totaldiskonservis;
                        $bagihasil = ($totalprofit/100) * $bonusservis;
                        $profitbersih = $totalprofit - $bagihasil;
                    @endphp
                    <div class="flex justify-end text-sm mb-2">
                        <div class="text-slate-400 italic">Rp. {{ number_format($profitbersih) }} <span class="text-slate-500">/</span> Rp. {{ number_format($totalbudgets) }}</div>
                    </div>
                    <div class="relative w-full h-2 bg-slate-600">
                        @if (($totalbiayaservis - $totalmodalservis - $totaldiskonservis + $totalsparepart + $totalaksesoris + $totalhandphone) / $totalbudgets * 100 <= 100)
                            <div class="absolute inset-0 bg-emerald-500" 
                                aria-hidden="true" 
                                style="width: {{ ($totalbiayaservis - $totalmodalservis - $totaldiskonservis + $totalsparepart + $totalaksesoris + $totalhandphone) / $totalbudgets * 100 }}%;">
                            </div>
                        @else
                            <div class="absolute inset-0 bg-emerald-500" 
                                aria-hidden="true" 
                                style="width: 100%;">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>