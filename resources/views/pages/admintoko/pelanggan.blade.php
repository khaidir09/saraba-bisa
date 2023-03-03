@section('title')
    Daftar Pelanggan
@endsection

<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Daftar Pelanggan ✨</h1>
            </div>

        </div>

        @if (session()->has('message'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif  

        <livewire:admin-customer-data></livewire:admin-customer-data>

    </div>
</x-admin-layout>
