@section('title')
    Laporan Pajak Penjualan
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-3">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Laporan Pajak Penjualan ✨</h1>
            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">
            <x-penjualan.card-laporan-produk-pajak-hari :produkhari="$produkhari" :ppnhari="$ppnhari"/>
            <x-penjualan.card-laporan-produk-pajak-bulan :produkbulan="$produkbulan" :ppnbulan="$ppnbulan"/>
            <x-penjualan.card-laporan-produk-pajak-tahun :produktahun="$produktahun" :ppntahun="$ppntahun"/>
        </div>
     
        <!-- Table -->
        <livewire:laporan-pajak-penjualan-data></livewire:laporan-pajak-penjualan-data>

    </div>
</x-toko-layout>