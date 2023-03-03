@section('title')
    Transaksi Servis Bisa Diambil
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Transaksi Servis ✨</h1>
            </div>

        </div>

        <!-- More actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">
        
            <!-- Left side -->
            <div class="mb-4 sm:mb-0">
                <ul class="flex flex-wrap -m-1">
                    <li class="m-1">
                        <a href="{{ route('transaksi-servis.index') }}">
                            <button class="inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">Proses <span class="ml-1 text-indigo-200">{{ $processes_count }}</span></button>
                        </a>
                    </li>
                    <li class="m-1">
                        <a href="{{ route('transaksi-servis-bisa-diambil.index') }}">
                            <button class="inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-transparent shadow-sm  bg-indigo-500 text-white duration-150 ease-in-out">Bisa Diambil <span class="ml-1 text-slate-400">{{ $jumlah_bisa_diambil }}</span></button>
                        </a>
                    </li>
                    <li class="m-1">
                        <a href="{{ route('transaksi-servis-sudah-diambil.index') }}">
                            <button class="inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">Sudah Diambil <span class="ml-1 text-slate-400">{{ $jumlah_sudah_diambil }}</span></button>
                        </a>
                    </li>
                </ul>
            </div>
        
        </div>
     
        <!-- Table -->
        <livewire:bisa-diambil-data></livewire:bisa-diambil-data>

    </div>
</x-toko-layout>
