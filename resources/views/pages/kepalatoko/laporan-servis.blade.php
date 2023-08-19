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

        {{-- Cetak Laporan --}}
        <section>
            <hr class="mt-10 mb-5">
            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-xl md:text-2xl text-slate-800 font-bold">Cetak Laporan Servis ✨</h1>
            </div>
            <div class="bg-white shadow-lg rounded-sm border border-slate-200 mt-5 mb-8 px-5 py-4">
                <h3 class="text-xl leading-snug text-slate-800 font-bold mb-1">Laporan PPN</h3>
                <form action="{{ route('cetak-laporan-ppn') }}" method="get">
                    <div class="sm:flex sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 mt-5">
                        <div class="sm:w-1/2">
                            <label class="block text-sm font-medium mb-1" for="owner">Pilih Bulan</label>
                            <select id="month" name="month" class="form-select text-sm py-2 w-full">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="sm:w-1/2">
                            <label class="block text-sm font-medium mb-1" for="nama_toko">Pilih Tahun</label>
                            <select id="year" name="year" class="form-select text-sm py-2 w-full">
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white w-full mt-4">Cetak Laporan</button>
                </form>
            </div>
        </section>

    </div>
</x-toko-layout>