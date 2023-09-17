<div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
    <div class="px-5 p-5">
        <header class="flex justify-between items-start mb-2">
            <!-- Icon -->
            <h2 class="text-lg font-semibold text-slate-800 mb-2">Bulan Ini</h2>
            <!-- Menu button -->
            <div class="text-sm font-semibold text-white px-1.5 bg-indigo-500 rounded-full">{{ \Carbon\Carbon::parse(strtotime(now()))->translatedFormat('F') }}</div>
        </header>
        <div class="flex justify-between">
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase mb-1">Jumlah</div>
                <div class="text-xl font-bold text-blue-500">{{ $jumlahbulan }}</div>
            </div>
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase mb-1">Biaya</div>
                <div class="text-xl font-bold text-emerald-500">Rp. {{ number_format($totalbiayabulan) }}</div>
            </div>
        </div>
    </div>
</div>
