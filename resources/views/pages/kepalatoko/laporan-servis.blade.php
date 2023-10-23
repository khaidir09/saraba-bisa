@section('title')
    Laporan Servis
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-3">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Laporan Servis ✨</h1>
            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">
            <x-servis.card-laporan-hari :omzethari="$omzethari" :profithari="$profithari"/>
            <x-servis.card-laporan-bulan :omzetbulan="$omzetbulan" :profitbulan="$profitbulan"/>
            <x-servis.card-laporan-tahun :omzettahun="$omzettahun" :profittahun="$profittahun"/>
        </div>
     
        <!-- Table -->
        <livewire:laporan-servis-data></livewire:laporan-servis-data>

    </div>
</x-toko-layout>