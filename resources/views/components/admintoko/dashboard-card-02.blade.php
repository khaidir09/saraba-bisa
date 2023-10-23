<div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
    <div class="px-5 pt-5">
        <header class="flex justify-between items-start mb-2">
            <!-- Icon -->
            <img src="{{ asset('images/icon-02.svg') }}" width="32" height="32" alt="Icon 02" />
            <!-- Menu button -->
            <div class="shrink-0 self-end ml-2">
                <a class="font-medium text-indigo-500 hover:text-indigo-600" href="{{ route('transaksi-servis-bisa-diambil.index') }}">Lihat<span class="hidden sm:inline"> -&gt;</span></a>
            </div>
        </header>
        <h2 class="text-lg font-semibold text-slate-800 mb-2">Servis Selesai Dikerjakan</h2>
        <div class="flex items-start">
            <div class="text-3xl font-bold text-slate-800 mr-2">{{ $servisselesai }}</div>
        </div>
    </div>
</div>
