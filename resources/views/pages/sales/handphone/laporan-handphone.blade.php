@section('title')
    Laporan Handphone
@endsection

<x-sales-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-3">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Laporan Penjualan Handphone ✨</h1>
            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">
            <x-sales.card-laporan-hari :profithari="$profithari"  :penjualanhari="$penjualanhari" />
            <x-sales.card-laporan-bulan :profitbulan="$profitbulan"  :penjualanbulan="$penjualanbulan" />
            <x-sales.card-laporan-tahun :profittahun="$profittahun"  :penjualantahun="$penjualantahun" />
        </div>
     
        <!-- Table -->
        <livewire:sales-laporan-handphone></livewire:sales-laporan-handphone>

    </div>
</x-sales-layout>