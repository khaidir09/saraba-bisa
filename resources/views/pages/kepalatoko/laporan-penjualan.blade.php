@section('title')
    Laporan Transaksi Produk
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-3">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Laporan Penjualan ✨</h1>
            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">
            <x-kepalatoko.card-laporan-penjualan-hari :omzethari="$omzethari" :profithari="$profithari"/>
            <x-kepalatoko.card-laporan-penjualan-bulan :omzetbulan="$omzetbulan" :profitbulan="$profitbulan"/>
            <x-kepalatoko.card-laporan-penjualan-tahun :omzettahun="$omzettahun" :profittahun="$profittahun"/>
        </div>
     
        <!-- Table -->
        <livewire:laporan-penjualan-data></livewire:laporan-penjualan-data>

    </div>
</x-toko-layout>