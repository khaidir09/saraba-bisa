@section('title')
    Daftar Pelanggan
@endsection

<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        @if (session()->has('message'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif  

        <livewire:admin-customer-data></livewire:admin-customer-data>

    </div>
</x-admin-layout>
