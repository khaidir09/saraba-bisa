@section('title')
    Produk Handphone
@endsection

<x-sales-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Produk Handphone ✨</h1>
            </div>

        </div>

        <!-- More actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">
        
            <!-- Left side -->
            <div class="mb-4 sm:mb-0">
                <ul class="flex flex-wrap -m-1">
                    <li class="m-1">
                        <a href="{{ route('sales-data-handphone.index') }}">
                            <button class="inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">Tersedia <span class="ml-1 text-indigo-200">{{ $phones_count }}</span></button>
                        </a>
                    </li>
                    <li class="m-1">
                        <a href="{{ route('sales-phone-terjual.index') }}">
                            <button class="inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-transparent shadow-sm  bg-indigo-500 text-white duration-150 ease-in-out">Terjual <span class="ml-1 text-slate-400">{{ $phones_terjual_count }}</span></button>
                        </a>
                    </li>
                </ul>
            </div>
        
        </div>
     
        <livewire:sales-phone-terjual-data></livewire:sales-phone-terjual-data>

    </div>
</x-sales-layout>
