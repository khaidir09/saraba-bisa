@section('title')
    Laporan Servis
@endsection

<x-teknisi-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-3">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Laporan Servis ✨</h1>
            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">
            <x-teknisi.card-laporan-hari :servishari="$servishari" :services="$services" :profithari="$profithari" :toko="$toko"/>
            <x-teknisi.card-laporan-bulan :servisbulan="$servisbulan" :services="$services" :profitbulan="$profitbulan" :toko="$toko"/>
            <x-teknisi.card-laporan-tahun :servistahun="$servistahun" :services="$services" :profittahun="$profittahun" :toko="$toko"/>
        </div>
     
        <!-- Table -->
        <livewire:teknisi-laporan-servis-data></livewire:teknisi-laporan-servis-data>

    </div>
</x-teknisi-layout>