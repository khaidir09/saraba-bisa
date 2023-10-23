<div class="bg-white shadow-lg rounded-sm border border-slate-200 mb-8">
    <header class="px-5 py-4">
        <h2 class="font-semibold text-slate-800">Semua Pelanggan <span class="text-slate-400 font-medium">{{ $count }}</span></h2>
    </header>
    <!-- Table -->
    <div class="overflow-x-auto">
        <livewire:customer-data></livewire:customer-data>
    </div>
</div>