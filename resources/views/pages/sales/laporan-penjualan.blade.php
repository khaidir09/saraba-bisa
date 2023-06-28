@section('title')
    Laporan Penjualan
@endsection

<x-sales-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-3">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Laporan Penjualan ✨</h1>
            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">
            <x-sales.card-laporan-hari :penjualanhari="$penjualanhari" :bonushari="$bonushari"/>
            <x-sales.card-laporan-bulan :penjualanbulan="$penjualanbulan" :bonusbulan="$bonusbulan"/>
            <x-sales.card-laporan-tahun :penjualantahun="$penjualantahun" :bonustahun="$bonustahun"/>
        </div>
     
        <!-- Table -->
        <livewire:sales-laporan-penjualan-data></livewire:sales-laporan-penjualan-data>

    </div>
</x-sales-layout>