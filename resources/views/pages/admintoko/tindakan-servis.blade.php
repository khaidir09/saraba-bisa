@section('title')
    Tindakan Servis
@endsection

<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Tindakan Servis ✨</h1>
            </div>

        </div>
     
        <livewire:admin-service-action-data></livewire:admin-service-action-data>

    </div>
</x-admin-layout>
