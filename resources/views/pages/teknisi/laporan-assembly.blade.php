@section('title')
    Laporan Perakitan & Pengecekan
@endsection

<x-teknisi-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-3">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Laporan Perakitan & Pengecekan ✨</h1>
            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">
            <x-teknisi.card-assembly-hari :assemblyhari="$assemblyhari" :assemblies="$assemblies" :bonushari="$bonushari"  />
            <x-teknisi.card-assembly-bulan :assemblybulan="$assemblybulan" :assemblies="$assemblies" :bonusbulan="$bonusbulan" />
            <x-teknisi.card-assembly-tahun :assemblytahun="$assemblytahun" :assemblies="$assemblies" :bonustahun="$bonustahun" />
        </div>
     
        <!-- Table -->
        <livewire:teknisi-laporan-assembly-data></livewire:teknisi-laporan-assembly-data>

    </div>
</x-teknisi-layout>