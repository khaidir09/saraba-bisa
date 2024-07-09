<div class="flex flex-col col-span-full sm:col-span-6 bg-white shadow-lg rounded-sm border border-slate-200">
    <div class="px-5 p-5">
        <header class="mb-2">
            <!-- Icon -->
            <h2 class="text-lg font-semibold text-slate-800">Terjual</h2>
        </header>
        <div class="flex justify-between">
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase mb-1">Item</div>
                <div class="text-xl font-bold text-blue-500">{{ $aksesorisstokhabis }}</div>
            </div>
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase mb-1">Nominal</div>
                <div class="text-xl font-bold text-emerald-500">Rp. {{ number_format($aksesorisnominalterjual) }}</div>
            </div>
        </div>
    </div>
</div>