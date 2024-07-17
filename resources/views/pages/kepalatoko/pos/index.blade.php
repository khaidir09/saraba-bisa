@section('title')
    Point of Sales (POS)
@endsection

<x-toko-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-3">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Point of Sales (POS) ✨</h1>
            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="flex flex-col col-span-full sm:col-span-6 bg-white shadow-lg rounded-sm border border-slate-200">
                <livewire:search-product />
            </div>
            <div class="flex flex-col col-span-full sm:col-span-6">
                <livewire:pos.index :cartInstance="'sale'" />
            </div>
        </div>
    </div>
</x-toko-layout>