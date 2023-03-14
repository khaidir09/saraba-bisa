@section('title')
    Persetujuan Kasbon
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Kasbon ✨</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Search form -->
                <x-search-form placeholder="Cari berdasarkan nomor transaksi" />                       
                
            </div>

        </div>
     
        <!-- Start -->
        <div x-data="{ modalOpen: true }">
            <!-- Modal backdrop -->
            <div
                class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity"
                x-show="modalOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-out duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                aria-hidden="true"
                x-cloak
            ></div>
            <!-- Modal dialog -->
            <div
                id="announcement-modal"
                class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6"
                role="dialog"
                aria-modal="true"
                x-show="modalOpen"
                x-transition:enter="transition ease-in-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in-out duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4"
                x-cloak
            >
                <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full">
                    <div class="p-6">
                        <div class="relative">
                            <!-- Close button -->
                            <a href="{{ route('kasbon.index') }}">
                                <button class="absolute top-0 right-0 text-slate-400 hover:text-slate-500" @click="modalOpen = false">
                                    <div class="sr-only">Close</div>
                                    <svg class="w-4 h-4 fill-current">
                                        <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                    </svg>
                                </button>
                            </a>
                            <!-- Modal header -->
                            <div class="mb-2 text-center">
                                <!-- Icon -->
                                <div class="inline-flex mb-2">
                                    <img src="{{ asset('images/announcement-icon.svg') }}" width="80" height="80" alt="Announcement" />
                                </div>
                                <div class="text-lg font-semibold text-slate-800">Persetujuan Kasbon</div>
                            </div>
                            <!-- Modal content -->
                            <div class="text-center">
                                <div class="text-sm mb-5">
                                    Apabila tidak ada masalah pada item kasbon yang diinputkan oleh admin, silahkan klik tombol Setuju.
                                </div>
                                <!-- CTAs -->
                                <form action="{{ route('kasbon.update', $item->id) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="flex justify-center space-x-2">
                                        <input type="submit" name="is_approve" value="Setuju" class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">
                                        <input type="submit" name="is_approve" value="Ditolak" class="btn-sm bg-red-500 hover:bg-red-600 text-white">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                                            
        </div>
        <!-- End -->

    </div>
</x-toko-layout>
